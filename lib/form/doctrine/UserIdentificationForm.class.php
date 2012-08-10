<?php

/**
 * UserIdentification form.
 *
 * @package    uas
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class UserIdentificationForm extends BaseUserIdentificationForm
{
  public function configure()
  {
		unset($this['created_at'], $this['updated_at']);


		$this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User')),
				array('class' => 'span4'
				));

		$this->widgetSchema->setLabels(array(
			'identification' => 'User Identification:',			
			'user_id' => 'User:'
				));
  }
}
