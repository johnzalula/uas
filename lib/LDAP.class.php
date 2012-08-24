<?php

class LDAP {

    private $_connection;

    public function __construct($ldap_ip, $ldap_user, $ldap_password) {
        $this->_connection = ldap_connect($ldap_ip)
                or die("Could not connect to ldap server");

        ldap_bind($this->_connection, $ldap_user, $ldap_password);
    }

    public function __destruct() {
        ldap_close($this->_connection);
    }

    // needs an UAS user object
    public function add_user($user) {
        if ($this->user_exists($user)) {
            $this->delete_user($user);
        }
        
        $udn = "uid=" . $user->getLogin() . ",ou=people,dc=mu,dc=edu,dc=et";

        $user_to_add = array();

        $user_to_add["objectClass"][0] = "inetOrgPerson";
        $user_to_add["objectClass"][1] = "posixAccount";
        $user_to_add["objectClass"][2] = "shadowAccount";
        $user_to_add["uid"] = $user->getLogin();
        $user_to_add["cn"] = $user->getName() . " " . $user->getFathersName() . " " . $user->getGrandFathersName();

        if (isset($user->getFathersName()) && $user->getFathersName() != "") {
            $user_to_add["sn"][0] = $user->getFathersName();
        }

        if (isset($user->getGrandFathersName()) && $user->getGrandFathersName() != "") {
            if ($user->getGrandFathersName() != $user->getFathersName()) {
                $user_to_add["sn"][1] = $user->getGrandFathersName();
            }
        }

        $user_to_add["givenName"] = $user->getName();
        $user_to_add["displayName"] = $user->getName() . " " . $user->getFathersName();
        $user_to_add["uidNumber"] = $user->getUid();
        $user_to_add["gidNumber"] = $user->getGid();

        if (isset($user->getUnixPassword()) && $user->getUnixPassword() != "") {
            $user_to_add["userPassword"] = "{SSHA}" . $user->getUnixPassword();
        } else {
            $user_to_add["userPassword"] = "";
        }

        $user_to_add["gecos"] = $user->getName() . " " . $user->getFathersName();

        $user_to_add["homeDirectory"] = $user->getHomeDirectory();

        $user_to_add["mail"] = $user->getEmailAddress();

        if (isset($user->getPhone()) && $user->getPhone() != "") {
            $user_to_add["homePhone"] = $user->getPhone();
        }

        ldap_add($this->_connection, $udn, $user_to_add);
    }

    public function delete_user($user) {
        if (!$this->user_exists($user)) {
            return;
        }

        $udn = "uid=" . $user->getLogin() . ",ou=people,dc=mu,dc=edu,dc=et";

        ldap_delete($this->_connection, $udn);
    }

    public function update_password($user) {
        $udn = "uid=" . $user->getLogin() . ",ou=people,dc=mu,dc=edu,dc=et";

        $user_to_modify = array();

        if (isset($user->getUnixPassword()) && $user->getUnixPassword() != "") {
            $user_to_modify["userPassword"] = "{SSHA}" . $user->getUnixPassword();
        } else {
            $user_to_modify["userPassword"] = "";
        }

        ldap_modify($this->_connection, $udn, $user_to_modify);
    }

    public function update_user($user) {
        // this is very lazy, but easy to understand and you will never need to 
        // update this function ;)

        $this->delete_user($user);
        $this->add_user($user);
    }

    public function user_exists($user) {
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
