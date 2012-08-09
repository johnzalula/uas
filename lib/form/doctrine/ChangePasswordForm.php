<?php

class ChangePasswordForm extends BaseForm
{
  public function configure()
  {
	unset($this['created_at'], $this['updated_at']);
	
   /* $this->setWidgets(array(
    'password'             =>new sfWidgetFormInputPassword(),
    'new_password'         =>new sfWidgetFormInputPassword(),
    'confirm_new_password' =>new sfWidgetFormInputPassword(),
    ));*/


		$this->widgetSchema['password'] = new sfWidgetFormInputPassword(array('always_render_empty' => false ), array('class' => 'span3 roundBox', 'placeholder' => 'Enter Current Password'));

		$this->widgetSchema['new_password'] = new sfWidgetFormInputPassword(array('always_render_empty' => false ), array('class' => 'span3 roundBox', 'placeholder' => 'Enter New Password'));

		$this->widgetSchema['confirm_new_password'] = new sfWidgetFormInputPassword(array('always_render_empty' => false ), array('class' => 'span3 roundBox', 'placeholder' => 'Enter Confirm New Password'));

    
    //labels
    $this->widgetSchema->setLabels(array(
    'password'              => 'Current Password:',
    'new_password'          => 'New Password:',
    'confirm_new_password'  => 'Confirm New Password:',
    ));
    //Validators
    $this->validatorSchema['password'] = new sfValidatorString(array('required' => true));

    $this->validatorSchema['new_password'] = new sfValidatorAnd(array(
    		new sfValidatorString(array('required' => true)),
    		new uasValidatorPasswordIsStrong()
		), 
        array(), array('invalid' => 'Your new password is not strong enough! <br />  The password should contain digits', 'required' => 'Please fill in you new password.')
    );

    $this->validatorSchema['confirm_new_password'] = new sfValidatorString(array('required' => true, 'min_length' => 8));

    $this->validatorSchema->setPreValidator(
        new sfValidatorSchemaCompare('new_password', '==', 'confirm_new_password',
            array('throw_global_error' => true),
         array('invalid' => 'Your confirmed password does not match.')
        )
    );

    
    $this->widgetSchema->setNameFormat('changepassword[%s]');  
  }
}

