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
    $this->user_list = UserPeer::doSelect(new Criteria());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new UserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($user = UserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $this->form = new UserForm($user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($user = UserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $this->form = new UserForm($user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($user = UserPeer::retrieveByPk($request->getParameter('id')), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $user->delete();

    $this->redirect('register/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $user = $form->save();

      $this->redirect('register/edit?id='.$user->getId());
    }
  }
}
