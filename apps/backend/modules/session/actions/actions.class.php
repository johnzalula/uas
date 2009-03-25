<?php

/**
 * session actions.
 *
 * @package    jobeet
 * @subpackage session
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class sessionActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('session/login');
  }

  public function executeLogin(sfWebRequest $request)
  {
    $username = $request->getParameter('username');
    $user_password = $request->getParameter('password');

    //Should be with a validator
    if(!$username OR !$user_password)
    {
        $this->getUser()->setFlash('error','You must provide Username / Password');
    }

    // Getting the user object
    $c = new Criteria();
    $c->add(UserPeer::LOGIN, $username);
    $user = UserPeer::doSelectOne($c);    

    // Check the user in db
    if($user)
    {
        $password = new Password($user_password);  

        if($user->checkPassword($password) && $user->getCredential())
        {
            $this->getUser()->addCredential($user->getCredential());
            $this->getUser()->setAuthenticated(true);
            $this->getUser()->setFlash('notice', "Welcome " . $user->getCredential());
            $this->redirect('@user');            
        }
    }
    $this->getUser()->setFlash('error','You are not authorized.');
  }
 
  public function executeLogout(sfWebRequest $request)
  {
    $this->getUser()->setAuthenticated(false);
    $this->getUser()->clearCredentials();

    $this->getUser()->resetUserHistory();

    $this->getUser()->setFlash('notice', 'You have been logged out!');
    $this->redirect('session/login');
  }

  private function get_login_from_config(sfWebRequest $request)
  {
  
  }

}
