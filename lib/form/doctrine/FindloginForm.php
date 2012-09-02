<?php

class FindloginForm extends BaseForm
{
  public function configure()
  {
    $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array('class' => 'span3 roundBox', 'placeholder' => 'Enter MU-Email Address'));

		

    $this->widgetSchema->setLabels(array(
    'email'              => 'Email:'
    ));

		
	$this->validatorSchema['email'] = new sfValidatorEmail(
        array('required' => true));

    
	$this->widgetSchema->setNameFormat('searchLogin[%s]');

  }
}
