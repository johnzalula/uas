<?php

class LDAP {

    private $_connection;

    // When we create this object we need to provide the details
    // Try to work with persistent connections?
    public function __construct() {
        $this->_connection = ldap_connect(sfConfig::get('app_ldap_host'))
                or die("Could not connect to ldap server");

	ldap_set_option($this->_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($this->_connection, LDAP_OPT_REFERRALS, 0);

        ldap_bind($this->_connection, sfConfig::get('app_ldap_user'), sfConfig::get('app_ldap_pass'));;
    }

    // Cleanup ofcourse
    public function __destruct() {
        ldap_close($this->_connection);
    }

    // needs an UAS user object
    // a User object is represented by /lib/model/doctrine/User.class.php
    public function add_user(User $user) {
        // Check if the user exists first, you never know ...
        if ($this->user_exists($user)) {
            $this->delete_user($user);
        }
        
        // This is where we will insert the user in LDAP
        $udn = "uid=" . $user->getLogin() . ",ou=people,dc=mu,dc=edu,dc=et";

        // Build the user in an array
        // More information: 
        $user_to_add = array();

        $user_to_add["objectClass"][0] = "inetOrgPerson";
        $user_to_add["objectClass"][1] = "posixAccount";
        $user_to_add["objectClass"][2] = "shadowAccount";
        $user_to_add["uid"] = $user->getLogin();
        $user_to_add["cn"] = $user->getName() . " " . $user->getFathersName() . " " . $user->getGrandFathersName();

        // Prevent empty sn's
        if ($user->getFathersName() != "") {
            $user_to_add["sn"][0] = $user->getFathersName();
        }

        // Prevent duplicate sn's
        if ($user->getGrandFathersName() != "") {
            if ($user->getGrandFathersName() != $user->getFathersName()) {
                $user_to_add["sn"][1] = $user->getGrandFathersName();
            }
        }

        $user_to_add["givenName"] = $user->getName();
        $user_to_add["displayName"] = $user->getName() . " " . $user->getFathersName();
        $user_to_add["uidNumber"] = $user->getUid();
        $user_to_add["gidNumber"] = $user->getGid();

        // Prepend {SSHA}
        if ($user->getUnixPassword() != "") {
            $user_to_add["userPassword"] = "{SSHA}" . $user->getUnixPassword();
        } else {
            $user_to_add["userPassword"] = "";
        }

        $user_to_add["gecos"] = $user->getName() . " " . $user->getFathersName();

        $user_to_add["homeDirectory"] = $user->getHomeDirectory();

        $user_to_add["mail"] = $user->getEmailAddress();

        // Prevent empty phone
        if ($user->getPhone() != "") {
            $user_to_add["homePhone"] = $user->getPhone();
        }

        return ldap_add($this->_connection, $udn, $user_to_add);
    }

    public function delete_user(User $user) {
        // Verify the existance first, you never know right
        if (!$this->user_exists($user)) {
            return false;
        }

        $udn = "uid=" . $user->getLogin() . ",ou=people,dc=mu,dc=edu,dc=et";
        return ldap_delete($this->_connection, $udn);
    }

    // Update the password (for the updating of SSHA)
    public function update_password(User $user) {
        $udn = "uid=" . $user->getLogin() . ",ou=people,dc=mu,dc=edu,dc=et";

        $user_to_modify = array();

        if ($user->getUnixPassword() != "") {
            $user_to_modify["userPassword"] = "{SSHA}" . $user->getUnixPassword();
        } else {
            $user_to_modify["userPassword"] = "";
        }

        return ldap_modify($this->_connection, $udn, $user_to_modify);
    }

    public function update_user(User $user) {
        // this is very lazy, but easy to understand and you will never need to 
        // update this function ;)

	//$user = UserTable::getInstance()->getUserFromLogin($user_login);
        $this->delete_user($user);

	$this->add_user($user);

	}

    public function user_exists(User $user) {
        $filter = '(|(uid=' . $user->getLogin() . '))';
        $dn = "ou=people,dc=mu,dc=edu,dc=et";
        $justthese = array('uid');

        $sr = ldap_search($this->_connection, $dn, $filter, $justthese);

        if (ldap_count_entries($this->_connection, $sr) != 1) {
		return false;
        }

        return true;
    }

}

?>
