<?php

class myUser extends sfBasicSecurityUser
{

	public function signIn(User $user)
    {
			
			$this->setAuthenticated(true);

			$this->setAttribute('uid', $user->getId());
			$this->setAttribute('login_name', $user->getLogin());
			$this->setAttribute('full_name', $user->getFullName());
			$this->setAttribute('first_name', $user->getName());
			$this->setAttribute('email_local_part', $user->getEmailLocalPart());
			$this->setAttribute('email_address', $user->getEmailAddress());

			$this->addCredential('user');
        

    }

	public function getCredential()
	{
		if($this->hasCredential('admin'))
		{
			$credential = 'admin'	;
		}
		else {
		 $credential = 'user';
		}

		return $credential;
	}

}
