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
    public function executeListToggleStatus(sfWebRequest $request)
    {
        $user = UserPeer::retrieveByPk($request->getParameter('id'));
        
        if($user->getStatus()=='activated')
        {
            $user->setStatus('disactivated');
        }
        elseif($user->getStatus()=='preregistered')
        {
            $user->setStatus('activated');
        }
        else
        {
            $user->setStatus('activated');
        }
        $user->save();
        $this->redirect('@user');
        
    }
    
    
    public function executeBatchToggle_status(sfWebRequest $request)
    {
        $ids = $request->getParameter('ids'); 
        $users = UserPeer::retrieveByPks($ids);
        
    foreach ($users as $user){
                   
        if($user->getStatus()=='activated')
        {
            $user->setStatus('disactivated');
        }
        elseif($user->getStatus()=='preregistered')
        {
            $user->setStatus('activated');
        }
        else
        {
            $user->setStatus('activated');
        }
         $user->save();
        
     }
       
       
        $this->redirect('@user');
       
        $this->getUser()->setFlash('notice', 'Status is changed successfully.');
        
    }
}
