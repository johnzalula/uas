<?php

/**
 * identification actions.
 *
 * @package    symfony
 * @subpackage identification
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class identificationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->user_identifications = Doctrine::getTable('UserIdentification')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->user_identification = Doctrine::getTable('UserIdentification')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->user_identification);
  }

  public function executeNew(sfWebRequest $request)
  {

		$user_id = $request->getParameter('user_id');
		$user_identity = new UserIdentification();
		$user_identity->setUserId($user_id);
    	$this->form = new UserIdentificationForm($user_identity);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new UserIdentificationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($user_identification = Doctrine::getTable('UserIdentification')->find(array($request->getParameter('id'))), sprintf('Object user_identification does not exist (%s).', $request->getParameter('id')));
    $this->form = new UserIdentificationForm($user_identification);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($user_identification = Doctrine::getTable('UserIdentification')->find(array($request->getParameter('id'))), sprintf('Object user_identification does not exist (%s).', $request->getParameter('id')));
    $this->form = new UserIdentificationForm($user_identification);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($user_identification = Doctrine::getTable('UserIdentification')->find(array($request->getParameter('id'))), sprintf('Object user_identification does not exist (%s).', $request->getParameter('id')));
    $user_identification->delete();

    $this->redirect('identification/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $user_identification = $form->save();

		$this->getUser()->setFlash('user_id_saved_success', true);

      $this->redirect('user/show?id='.$user_identification->getUserId());
    }
  }
}
