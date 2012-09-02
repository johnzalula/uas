<?php

class UserTable extends Doctrine_Table
{

	
	public static function getInstance()
    {
        return Doctrine_Core::getTable('User');
    }

	static function getQuery($status)
	{
		if($status == "all_users")
		{
			return Doctrine_Query::create()
			->from('User u')
			->orderBy('u.name ASC');
		}

		return Doctrine_Query::create()
			->from('User u')
			->where('u.status=?', array($status))
			->orderBy('u.name ASC');
	}	

	public function addUsersToQuery(Doctrine_Query $q)
	{
		$alias = $q->getRootAlias();
		//$q->andWhere($alias.".expires_at > ?", date('Y-m-d H:i:s', time()));
		//$q->andWhere($alias.'.is_activated = ?', 1);
		return $q;
	}

	public function getUsersQuery($status)
	{
		return $this->addUsersToQuery(self::getQuery($status));
	}

	public function getUsers()
	{
		$q = $this->createQuery('u')
	     ->orderBy('u.name ASC');
	   
		return $q->execute();
	}

    static public $status_types = array (
        'activated' => 'Activated',
        'disactivated' => 'Disactivated',
        'preregistered' => 'Preregistered',
        );
    static public $gid_types = array (
        '2000' => 'User',
        '2001' => 'System',
        '2002' => 'Other',
        );

    static public function getMaxUid()
	{
		$result = Doctrine::getTable('User')->createQuery('c')->select('MAX(c.uid) AS uid')->fetchArray();
		return $result[0]['uid'];
	}

	static public function check_if_login_exists($login = "")
	{
		return Doctrine::getTable('User')->createQuery('q')->where('login = ?', $login)->count() == 0;
	}

    static public function check_if_local_part_exists($local_part = "")
    {
		$data = Doctrine::getTable('User')->findOneByEmailLocalPart($local_part);
    	return !$data;
    }

	static public function getUserFromLogin($login)
	{
		return Doctrine::getTable('User')->findOneByLogin($login);
	}
	
	static public function getUserFromEmailLocalPart($email_local_part)
	{
	     $c = new Criteria();
          $c->add(self::EMAIL_LOCAL_PART, $email_local_part);
          return self::doSelectOne($c);	   
	}	
	
	public function getEmailAccounts()
	{
	     $criteria = new Criteria();
         	$criteria->add(self::STATUS, 'activated');
         	$criteria->addOr(self::STATUS, 'disactivated');
      
         	return self::doSelect($criteria);
         	
	}

	public function getUserByIdAndPassword($uid, $userpassword)
	{
		$password_hash = crypt($userpassword, sfConfig::get('app_crypt_salt'));

		$user = Doctrine_Query::create()
                        ->from('User u')
                        ->where('u.id=? AND crypt_password=?',
                                    array($uid, $password_hash))
                        ->fetchOne();

        if ($user &&
            $user->getId() == $uid && $user->getCryptPassword() == $password_hash ) {

            return $user;
        }

        return null;
	}

	public function login($username, $password)
    {
			
			$password_hash = crypt($password, sfConfig::get('app_crypt_salt'));
			
        $user = Doctrine_Query::create()
                        ->from('User u')
                        ->where('u.login=? AND crypt_password=?',
                                    array($username, $password_hash))
                        ->fetchOne();

        if ($user &&
            $user->getLogin() == $username && $user->getCryptPassword() == $password_hash ) {

            return $user;
        }

        return null;
    }


	public function getUserByEmail($email)
	{
		if(($email == null))
		{
			return null;
		}
		
			$user = Doctrine_Query::create()
						->from('User u')
						->where('u.email_local_part=?',
										array($email))
						->fetchOne();

		if($user) 
		{

			return $user;
		}

		return null;
	}

	public function getUserStatus($user_status)
    {
			
        $users = Doctrine_Query::create()
                        ->from('User u')
                        ->where('u.status=?', array($user_status));


           return $users->execute();
    }

}

