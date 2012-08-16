<?php

/**
 * RegisterUser form.
 *
 * @package    uas
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class RegisterUserForm extends UserForm
{
  public function configure_specific()
  {
    parent::configure_specific();
    unset(
        $this['created_at'], $this['updated_at'], $this['expires_at'],
        $this['login'], 
        $this['nt_password'], $this['lm_password'], $this['crypt_password'], $this['unix_password'],
        $this['email_quota'], $this['email_local_part'],
        $this['gid'], $this['uid'],
		$this['domainname_id'],
		$this['status']
        ); 


		$this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('class' => 'span3 roundBox', 'placeholder' => 'Enter name'));

		$this->widgetSchema['fathers_name'] = new sfWidgetFormInputText(array( ), array('class' => 'span3 roundBox', 'placeholder' => 'Enter fathers name'));

		$this->widgetSchema['grand_fathers_name'] = new sfWidgetFormInputText(array( ), array('class' => 'span3 roundBox', 'placeholder' => 'Enter grand fathers name'));

		
		$this->widgetSchema['phone'] = new sfWidgetFormInputText(array(), array('class' => 'span2 roundBox', 'placeholder' => 'Enter phone number'));

		
		$this->widgetSchema['alternate_email'] = new sfWidgetFormInputText(array(), array('class' => 'span3 roundBox', 'placeholder' => 'Enter alternative email'));

		 $this->widgetSchema->setLabels(array(
		 'name'               => 'Name:',
		 'fathers_name'       => 'Fathers Name:',
		 'grand_fathers_name' => 'Grand Fathers Name:',
		 'phone'              => 'Phone No:',
		 'alternate_email'    => 'Alternative Email:'
		 ));
	
  }

		
}
