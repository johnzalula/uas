<?php

/**
* user actions.
*
* @package    uas
* @subpackage user
* @author     Your name here
* @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
*/
class userActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$current_id = $this->getUser()->getAttribute('user_id');
		$this->redirect('user/edit?id='.$current_id);

	}
	public function executeShow(sfWebRequest $request)
	{
		$current_id = $this->getUser()->getAttribute('uid');
		$requested_id= $request->getParameter('id');

		if($current_id == $requested_id )
		{       
			$this->user = Doctrine::getTable('User')->find($request->getParameter('id'));
			$this->forward404Unless($this->user);
		}
		else
		{     
			$this->getUser()->setFlash('notice', 'Please View Your Details Only!');       
			$this->redirect('user/show?id='.$current_id);
		}
	}
	public function executeEdit(sfWebRequest $request)
	{
		$current_id = $this->getUser()->getAttribute('uid');
		$requested_id= $request->getParameter('id');

		if($current_id == $requested_id )
		{ 
			$this->forward404Unless($user = Doctrine::getTable('User')->find($request->getParameter('id')), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
			$this->form = new FrontendUserForm($user);
		}
		else
		{       
			$this->redirect('user/edit?id='.$current_id);
		}
		
		
	}
	public function executeUpdate(sfWebRequest $request)
	{
		/*$this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
		$this->forward404Unless($user = Doctrine::getTable('User')->find($request->getParameter('id')), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
		$this->form = new FrontendUserForm($user);
		$this->processForm($request, $this->form);
		$this->setTemplate('edit');*/

		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($user = Doctrine_Core::getTable('User')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $this->form = new FrontendUserForm($user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$user = $form->save();
			
			$this->getUser()->setFlash('saved_user_success', true);
			$this->redirect('user/edit?id='.$user->getId());
		}
	}

	public function executeChangepassword(sfWebRequest $request)
	{
		$user_id = $request->getParameter('user_id');
		$user_email = $request->getParameter('user_email');


		$this->form = new ChangePasswordForm();
		
		
		
		if($request->isMethod('post') || $request->isMethod('put')){ // if the form is submitted

			$this->form->bind($request->getParameter('changepassword'));
			if ($this->form->isValid())
			{
				$pass_parameters = $request->getParameter('changepassword');
				$password = new Password($pass_parameters['new_password']);
				$current_password = $pass_parameters['password'];

				$uid = $this->getUser()->getAttribute('uid');
				$email_local_part = $this->getUser()->getAttribute('email_local_part');

			$user = UserTable::getInstance()->getUserByIdAndPassword($uid, $current_password);

				if($user)
				{        

					$current_pass = new Password($current_password);
					if($user->checkPassword($current_pass)) {  

						$user->setPasswordObject($password);
						$user->save();
						$changed_pass = $password->getPassword();
						$this->getUser()->setAttribute('changed_password', $changed_pass);
						$this->getUser()->setFlash('notice_success', true);
						$this->redirect('user/show?id='.$user->id);

					$message = $this->getMailer()->compose(
							array('send2joni@gmail.com' => 'UAS Password'),
										$user->getAlternateEmail(),
							'Your UAS Password',
							'your uas pass word is {$changed_pass}');
							$this->getMailer()->send($message);


                // generate welcome mail
              /*  $body = $this->getPartial('changepassword',
                    array('user'=>$user,
                    'password'=>$changed_pass));

                $subject = sfContext::getInstance()->getI18N()
                    -> ('Your UAS account Information');
                
                $mailserver = sfConfig::get('app_system_email');
                
                $mailer = $this->getMailer();                
                $message = $mailer->compose($mailserver['from'], 
                                            $user->alternate_email,
                                            $subject);

                $message->setBody($body, 'text/html');

		             try {
		                 $mailer->send($message);
		             }
		             catch (Exception $e) {
		                 $this->log($e->getMessage());
		             }*/

					} else {

							$this->getUser()->setFlash('current_password_failure', true);
							$this->redirect('user/changepassword?user_id='.$user_id.'&user_mail='.$email_local_part);
				
						}
				}
				else {
					
				$this->getUser()->setFlash('user_change_failure', true);
					$this->redirect('user/changepassword?user_id='.$user_id.'&user_mail='.$email_local_part);
				}

				
			}
		 else { // not a post, just a get
			//		$this->setTemplate('changepassword');
			}
		}

	}
}
