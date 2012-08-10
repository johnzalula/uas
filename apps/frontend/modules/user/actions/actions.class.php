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
			$this->form = new UserForm($user);
		}
		else
		{       
			$this->redirect('user/edit?id='.$current_id);
		}
	}
	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
		$this->forward404Unless($user = Doctrine::getTable('User')->find($request->getParameter('id')), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
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
				$user_email_local = $this->getUser()->getAttribute('first_name');

			$user = UserTable::getInstance()->getUserByIdAndPassword($uid, $current_password);

				if($user)
				{           
					$user->setPasswordObject($password);
					$user->save();
					$this->getUser()->setFlash('notice_success', true);
					$this->redirect('user/show?id='.$user->id);
				}
				else {
					$this->redirect('user/changepassword?user_id='.$user_id.'&user_email='.$user_email);
				$this->getUser()->setFlash('user_change_failure', true);
				}

				
			}
		 else { // not a post, just a get
			//		$this->setTemplate('changepassword');
			}
		}

	}
}
