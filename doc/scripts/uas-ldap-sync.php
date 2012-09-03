<?php

/* database connnection information */
$user = "uas";
$pass = "";
$host = "localhost";
$db = "uas";

/* ldap connection information */
$ldap_server = "ldap://ldap.mu.edu.et";
$ldap_user = "cn=admin,dc=mu,dc=edu,dc=et";
$ldap_password = "";

$ds = ldap_connect($ldap_server)
        or die("Could not connect to ldap server");

ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

$result_bind = ldap_bind($ds, $ldap_user, $ldap_password);

if (!$result_bind) {
    die("Could not bind to ldap server");
}

// Establish database connection
$con = mysql_connect($host, $user, $pass) or die("MySQL connection error: " . mysql_error());
mysql_select_db($db, $con) or die("Database error: " . mysql_error());

$sql = "select 
    u.login AS login, 
    u.name AS name,
    u.fathers_name AS fathers_name,
    u.grand_fathers_name AS grand_fathers_name,
    u.uid AS uid,
    u.gid AS gid,
    CONCAT('{SSHA}', u.unix_password) AS ssha_password,
    CONCAT('{CRYPT}', u.crypt_password) AS crypt_password,
    CONCAT(u.email_local_part, '@', d.name) AS uas_email,
    CONCAT('/home/', SUBSTRING(u.login, 1, 1), '/', SUBSTRING(u.login, 1, 2), '/', u.login) AS homeDirectory,
    u.phone AS phone,
    u.updated_at
    from user u INNER JOIN domain_name d ON u.domainname_id = d.id
    WHERE u.status = 'activated'";

$result_activated = mysql_query($sql) or die(mysql_error());

// iterate over the uas users and look in the ldap server
while ($obj = mysql_fetch_object($result_activated)) {
    $dn = "ou=people,dc=mu,dc=edu,dc=et";

    // the User DN 
    $udn = "uid=" . $obj->login . "," . $dn;

    // request modify timestamp
    $attrs = array('modifytimestamp');
    $search = ldap_read($ds, $udn, '(objectClass=*)', $attrs);
    if ($search) {
        $entry = ldap_get_entries($ds, $search);
        $ldap_update_time = _valueFromLdapDateTime($entry[0]['modifytimestamp'][0]);
        $uas_update_time = strtotime($obj->updated_at);

        // if the timestamp of ldap is bigger or the same then the uas'es 
        // ignore the user
        if ($ldap_update_time >= $uas_update_time) {
            continue; // ignore this user and go to the next
        }
    }

    $user_to_add = array();

    // create the user object to add to ldap
    $user_to_add["objectClass"][0] = "inetOrgPerson";
    $user_to_add["objectClass"][1] = "posixAccount";
    $user_to_add["objectClass"][2] = "shadowAccount";
    $user_to_add["uid"] = $obj->login;
    $user_to_add["cn"] = $obj->name . " " . $obj->fathers_name . " " . $obj->grand_fathers_name;

    // prevent empty sn
    if (isset($obj->fathers_name) && $obj->fathers_name != "") {
        $user_to_add["sn"][0] = $obj->fathers_name;
    }

    // prevent double sn
    if (isset($obj->grand_fathers_name) && $obj->grand_fathers_name != "") {
        if ($obj->grand_fathers_name != $obj->fathers_name) {
            $user_to_add["sn"][1] = $obj->grand_fathers_name;
        }
    }

    $user_to_add["givenName"] = $obj->name;
    $user_to_add["displayName"] = $obj->name . " " . $obj->fathers_name;
    $user_to_add["uidNumber"] = $obj->uid;
    $user_to_add["gidNumber"] = $obj->gid;

    // add the crypt password if there is no SSHA password
    if (isset($obj->ssha_password) && $obj->ssha_password != "{SSHA}" && $obj->ssha_password != "") {
        $user_to_add["userPassword"] = $obj->ssha_password;
    } else {
        $user_to_add["userPassword"] = $obj->crypt_password;
    }

    $user_to_add["gecos"] = $obj->name . " " . $obj->fathers_name;

    $user_to_add["homeDirectory"] = $obj->homeDirectory;

    $user_to_add["mail"] = $obj->uas_email;

    // prevent an empty phone number
    if (isset($obj->phone) && $obj->phone != "") {
        $user_to_add["homePhone"] = $obj->phone;
    }

    // search for the DN of the user
    $sr = ldap_search($ds, $dn, "(uid=" . $obj->login . ")");

    // if the user exists, delete it (basic)
    if (ldap_count_entries($ds, $sr) == 1) {
        echo "Modifying user: " . $obj->login;
        $result_add = ldap_modify($ds, $udn, $user_to_add);
        echo " done\n";
    } else {
        echo "Adding user: " . $obj->login;
        $result_add = ldap_add($ds, $udn, $user_to_add);
        echo " done\n";
    }

    if (!$result_add) {
        die("Could not add user: " . $obj->login);
    }
}

// Remove all users that might still exist in LDAP but are not activated in UAS
$sql = "SELECT login FROM user WHERE status != 'activated'";

$result_not_activated = mysql_query($sql);

while ($obj = mysql_fetch_object($result_not_activated)) {
    // the people directory
    $dn = "ou=people,dc=mu,dc=edu,dc=et";

    // the User DN 
    $udn = "uid=" . $obj->login . "," . $dn;

    // search for the DN of the user
    $sr = ldap_search($ds, $dn, "(uid=" . $obj->login . ")");

    // if the user exists, delete it (basic)
    if (ldap_count_entries($ds, $sr) == 1) {
        echo "Deleting not activated user: " . $obj->login;
        $result_delete = ldap_delete($ds, $udn);
        echo " done\n";
    }
}

// In an ideal world we would now search through all the LDAP users to find
// users that are not in UAS

mysql_close($con);
ldap_close($ds);

// Convert the LDAP time format to the PHP timestamp format
function _valueFromLdapDateTime($value) {
    $matches = array();
    if (preg_match('/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})([+-]\d{4}|Z)$/', $value, $matches)) {
        $year = $matches[1];
        $month = $matches[2];
        $day = $matches[3];
        $hour = $matches[4];
        $minute = $matches[5];
        $second = $matches[6];
        $timezone = $matches[7];
        $date = gmmktime($hour, $minute, $second, $month, $day, $year);
        if ($timezone !== 'Z') {
            $tzDirection = substr($timezone, 0, 1);
            $tzOffsetHour = substr($timezone, 1, 2);
            $tzOffsetMinute = substr($timezone, 3, 2);
            $tzOffset = ($tzOffsetHour * 60 * 60) + ($tzOffsetMinute * 60);
            if ($tzDirection == '+')
                $date -= $tzOffset;
            else if ($tzDirection == '-')
                $date += $tzOffset;
        }
        return $date;
    }
    else
        return null;
}
?>


