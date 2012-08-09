<?php

class LoginForm extends BaseForm
{
  public function configure()
  {
    $this->widgetSchema['login'] = new sfWidgetFormInputText(array(), array('class' => 'span3 roundBox', 'placeholder' => 'Username or email'));

		$this->widgetSchema['password'] = new sfWidgetFormInputPassword(array('always_render_empty' => false ), array('class' => 'span3 roundBox', 'placeholder' => 'Password'));


    $this->widgetSchema->setLabels(array(
    'login'              => 'Username',
    'password'          => 'Password',
    ));

    $this->validatorSchema['login'] = new sfValidatorAnd(array(
		new sfValidatorString(array('required' => true)),
		new uasValidatorLoginExists()
		));
    $this->validatorSchema['password'] = new sfValidatorAnd(array(
		new sfValidatorString(array('required' => true)),
		new uasValidatorPasswordIsCorrect(array('login' => 'credentials[login]'))
		));
    
    $this->widgetSchema->setNameFormat('credentials[%s]');   
  }
}
