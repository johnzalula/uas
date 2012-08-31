<?php

/**
 * register actions.
 *
 * @package    uas
 * @subpackage register
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class registerActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('register/new');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RegisterUserForm();
  }

  public function executeConfirm(sfWebRequest $request)
  {      
        $this->user = UserPeer::retrieveByPk($request->getParameter('id'));  
  }

  public function executeCreate(sfWebRequest $request)
  {

	$this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RegisterUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');

  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

    	if ($form->isValid())
    	{
			//if($this->user->getGeneratedPassword()){
          //  $this->getUser()->setFlash('generated_pass', $this->user->getGeneratedPassword());
				
				$new_user = new User();
				//$generate_pass = $new_user->getGeneratedPassword();
            //$this->getUser()->setAttribute('user_id' , $this->user->getId());				
            //$this->getUser()->setAttribute('user_id' , $this->user->getId()); 
				
				
            //$this->getUser()->setFlash('notice', 'Welcome'. ' ' . $this->user);

				$password = new Password();
				//$this->user->setPasswordObject($password);
	
			 // Flash message
			 
			 //$this->user->save();
			 //$this->getUser()->setFlash('generated_pass', $generated_pass);
            
	    
			  	$this->user = $form->save();
			  	$this->user->setStatus('preregistered');
			  	$this->user->setPasswordObject($password);

				$generated_pass = $password->getPassword();

			  	$this->user->save();
				
    			$this->getUser()->setFlash('generated_pass', $generated_pass);
            $this->getUser()->setAuthenticated(true);
				$this->getUser()->setAttribute('uid', $this->user->id);
				$this->getUser()->setAttribute('login_name', $this->user->login);
				$this->getUser()->setAttribute('full_name', $this->user->getFullName());
				$this->getUser()->setAttribute('first_name', $this->user->name);
				$this->getUser()->setAttribute('email_local_part', $this->user->email_local_part);
				$this->getUser()->setAttribute('email_address', $this->user->getEmailAddress());    

			$this->getUser()->setFlash('welcome_notice_success', true);
			$this->redirect('user/show?id='.$this->user->id.'&user_mail='.$this->user->email_local_part);
    	} 
		//} 
	}
  
}
