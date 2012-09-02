<?php

/**
 * session actions.
 *
 * @package    uas
 * @subpackage session
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class sessionActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
 public function executeIndex(sfWebRequest $request)
  {
    //$this->redirect('session/login');
		$this->setLayout('login');
  }

	public function executeLogin(sfWebRequest $request)
	{
		$this->getUser()->setAuthenticated(false);
		$this->getUser()->clearCredentials();
		$this->form = new LoginForm();
		$this->setLayout('login');
	}
/*
    $login= $this->getRequestParameter('login');
    $password= new Password($this->getRequestParameter('password'));
  
    $c->add(UserPeer::CRYPT_PASSWORD, $password->getCryptHash());
 
*/

	public function executeDologin(sfWebRequest $request)
	{
		
			$credentials = $request->getParameter('credentials');
			//$login = $credentials['login'];

			$username = $credentials['login'];
			$password = $credentials['password'];
		
		$user = UserTable::getInstance()->login($username, $password);

		if($user)
		{
				if ($user->status == !"activated" ) 
					{
				     $this->getUser()->setAuthenticated(false);
				     $this->getUser()->setFlash('login_failure.activation', true);
				     $this->forward('session', 'index');
		   		}

				$this->getUser()->signIn($user);
				

					$password_update = new Password($password);
		   		$user->setPasswordObject($password_update);
					$user->save();

					
					$this->getUser()->setFlash('notice', 'Welcome'. ' ' . $user->getLogin());
					$this->redirect('user/show?id='.$user->getId());
	   	 }
	    	else 
				{
					$this->getUser()->setAuthenticated(false);
					$this->getUser()->setFlash('login_failure_notice', true);

					$this->forward('session', 'login');
	    		}	
	}

  public function executeSignout(sfWebRequest $request)
  {
		$this->getUser()->setAuthenticated(false);
		$this->getUser()->setAttribute('id', null);
		$this->getUser()->clearCredentials();
		$this->getResponse()->setCookie('autologin', 0, 0);
		$this->getUser()->setFlash('notice', 'See you again soon!');
		$this->redirect('session/login');
  } 
  public function executeComment(sfWebRequest $request){
     $this->redirect('@comment');
  } 
 }





