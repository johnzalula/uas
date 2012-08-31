<?php

require_once dirname(__FILE__).'/../lib/userGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/userGeneratorHelper.class.php';

/**
 * user actions.
 *
 * @package    uas
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class userActions extends autoUserActions
{

	/*public function executeIndex(sfWebRequest $request)
	{
		
			$this->forward('user', 'listShow');
	}
*/
	///public function executeIndex(sfWebRequest $request)
	//{
	//}

	public function executeShow(sfWebRequest $request)
	{
		if($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('admin'))
		{
			$pagesize = $request->getParameter('pagesize', 5);

			$status = $request->getParameter('user_status');

			$this->users = Doctrine::getTable('User')->getUserStatus($status);
			//$this->getUser()->setAttribute('user_status', $status);

			$this->pager = new sfDoctrinePager('User', $pagesize);

			$query = Doctrine::getTable('User')->getUsersQuery($status);	
			//$this->getRequest()->setParameter('user_status', $status);

			$this->pager->setQuery($query);	
			$this->pager->setPage($request->getParameter('page', 1));
			$this->pager->init();

		}
		else {
			$this->redirect('@sf_guard_signin');
		}

	}
		
	public function executeActivate(sfWebRequest $request)
	{
		if($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('admin'))
		{
			$user = UserTable::getInstance()->find($request->getParameter('user_id'));
			$this->forward404Unless($user);
		
				$user->status = "activated";
				$user->save();

				$this->getUser()->setFlash('user_activated.success', 1);

				$this->redirect('user/show?user_status=disactivated');
		}
		else {

			$this->redirect('@sf_guard_signin');
		}
	}


	public function executeDisactivate(sfWebRequest $request)
	{
		if($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('admin'))
		{
			$user_status = $request->getParameter('user_status');
			$user = UserTable::getInstance()->find($request->getParameter('user_id'));
			$this->forward404Unless($user);
		
				$user->status = "disactivated";
				$user->save();

				$this->getUser()->setFlash('user_disactivated.success', 1);

				$this->redirect('user/show?user_status=activated');
		}
		else {
			$this->redirect('@user');
		}
	}

	public function executeBatch(sfWebRequest $request)
    {
			$user_status = $request->getParameter('user_status');
        $ids = array_keys($request->getParameter('check-box', array()));

		if(!empty($ids)) {
        $query = Doctrine_Query::create()
                    ->update('User u');
							

        switch ($request->getParameter('groupaction')) {
            case 'Disactivate': $query->set('status', '?','disactivated'); 
							$this->getUser()->setFlash('disactivated.success', 1);
						break;
            case 'Activate': $query->set('status', '?', 'activated'); 
							$this->getUser()->setFlash('activated.success', 1);
						break;
            case 'Delete': $query->set('deleted_at', '?', date('Y-m-d H:i:s')); 
							$this->getUser()->setFlash('deleted.success', 1);
						break;
				default:
						$this->getUser()->setFlash('select.error', 1);
						$this->redirect('user/show?user_status='.$user_status);
						break;
        			}

				   $query->whereIn('u.id', $ids);
				   $query->execute();
				}
				else {
					$this->getUser()->setFlash('selectfield.error', 1);
				}

        $this->redirect('user/show?user_status='.$user_status);
    }
    public function executeListToggleStatus(sfWebRequest $request)
    {
        //$user = UserPeer::retrieveByPk($request->getParameter('id'));
       // $user = $this->getRoute()->getObject();
        $id = $request->getParameter('id'); 
        $user = Doctrine::getTable('User')->find($id);
       
        $user->ToggleStatus();
        $this->getUser()->setFlash('notice', 'Status is changed successfully.');
        $this->redirect('@user');  
    } 
    public function executeBatchToggle_status(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids'); 
		$users = Doctrine::getTable('User')->createQuery('q')->whereIn('id', $ids)->execute();
        foreach ($users as $user)
        {
            $user->ToggleStatus();        
        }
       $this->getUser()->setFlash('notice', 'Status is changed successfully.');
       $this->redirect('@user');
    }
    public function executeListShow(sfWebRequest $request)
	{      
		if($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('admin'))
		{		
		     $this->user = $this->getRoute()->getObject();
		     $this->getUser()->addUserToHistory($this->user); 	
		}
		else {
		$this->redirect('@sf_guard_signin');
		}
    }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $this->user = $this->getRoute()->getObject();
    $user->delete();

    $this->redirect('user/index');
  }

  public function executeResetpassword(sfWebRequest $request)
  {
    // Get the current user
    $this->user = $this->getRoute()->getObject();

    // Set the password
    $password = new Password();
		$this->user->setPasswordObject($password);
	
    // Flash message
    $generated_pass = $password->getPassword();
	 $this->user->save();
    $this->getUser()->setFlash('generated_pass', $generated_pass);
    $this->getUser()->setFlash('notice', "User password has been reset");

    // Redirect the user back to the user's page
    $this->redirect('user/ListShow?id='.$this->user->getId());
  }

  public function executeListExtend(sfWebRequest $request)
  {
        $id = $request->getParameter('id'); 
        $this->user = $this->getRoute()->getObject();
       
        $this->user->displayExtendExpiresAt();
        $this->getUser()->setFlash('notice', 'Account expriry time has been extended successfully.');
        $this->redirect('user/ListShow?id='.$id);    
  }

  public function executeListDelete(sfWebRequest $request)
  {
        /*$id = $request->getParameter('id'); 
        $user = UserPeer::retrieveByPk($id);
       
        $user->listDelete();
        $this->getUser()->setFlash('notice', 'User Account has been Deleted from Database');
        $this->redirect('@user');*/
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@user');   
  }

	public function executeEdit(sfWebRequest $request)
	{
		$user = $this->getRoute()->getObject();
		
		// SAMBA FORM		
		$this->samba_form = new EmbeddedSambaAccountForm();
		$this->samba_form->setDefault('user_id', $user->getId());

		// FTP FORM
		$this->ftp_form	  = new EmbeddedFtpAccountForm();
		$this->ftp_form->setDefault('user_id', $user->getId());

		// UNIX FORM
		$this->unix_form	  = new EmbeddedUnixAccountForm();
		$this->unix_form->setDefault('user_id', $user->getId());

		return parent::executeEdit($request);
	}
}


