<?php

/**
 * find_login actions.
 *
 * @package    symfony
 * @subpackage find_login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class find_loginActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	public function executeIndex(sfWebRequest $request)
	{
		 $this->redirect('find_login/search');
	}

	
	public function executeSearch(sfWebRequest $request )
	{		
		$this->form = new FindloginForm();
		
		if($request->isMethod('post') || $request->isMethod('put'))
		{

			$this->form->bind($request->getParameter('searchLogin'));
			if ($this->form->isValid())
			{

				$searchLogin = $request->getParameter('searchLogin');

				$email = $searchLogin['email'];
				$identification = $searchLogin['identification'];
			
				$email_at_pos = strpos($email, '@');
				$email_local_part = substr($email, 0, $email_at_pos);
		
				$user = UserTable::getInstance()->getUserByEmail($email_local_part);

				if($user)
				{
				
					$this->getUser()->setFlash('search.success', true);
					$this->redirect('find_login/show?id='.$user->id);
					
					
				}
				else
				{
					$this->getUser()->setAttribute('user_name', $email);
					$this->getUser()->setAttribute('user_test', $email_local_part);
					$this->getUser()->setFlash('search.failure', true);
					$this->redirect('find_login/search');
				}

			}
		}

		
	}

	public function executeShow(sfWebRequest $request)
	{
		$requested_id= $request->getParameter('id');

		$this->user = Doctrine::getTable('User')->find($request->getParameter('id'));
		$this->forward404Unless($this->user);
			
	}
}
