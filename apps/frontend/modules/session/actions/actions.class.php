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
    $this->redirect('session/login');
  }
  public function executeLogin(sfWebRequest $request)
   {
       $login= $this->getRequestParameter('login');
       $c = new Criteria();
       $c->add(UserPeer::LOGIN, $login);
       $user = UserPeer::doSelectOne($c);   
      if  ($user){
           if (true)
          {    
                $this->getUser()->setAuthenticated(true);
	        $this->getUser()->setFlash('notice', 'Welcome'.$user->getLogin());
                $this->redirect('user/show?id='.$user->getId());
          }
      }
   }
    public function executeShow(sfWebRequest $request){
		
	}

	public function executeLogout(sfWebRequest $request)
	{
		$this->getUser()->setAuthenticated(false);
		$this->getUser()->setFlash('notice', 'You have been logged out!');
		$this->redirect('@user');
	}
	  
 }

