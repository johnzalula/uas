<?php

/**
	* BackendUser form.
	*
	* @package    uas
	* @subpackage form
	* @author     Your name here
	* @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
	*/
class BackendUserForm extends UserForm
{
	public function configure_specific()
	{
		parent::configure_specific();
		unset(
			$this['created_at'], $this['updated_at'],
			$this['login'], 
			$this['nt_password'], $this['lm_password'], $this['crypt_password'], $this['unix_password'],
			$this['email_local_part'],
			$this['gid'], $this['uid'],
			$this['domainname_id'],
			$this['expires_at']
			); 
		$this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('class' => 'span3', 'placeholder'=>'Enter Name'));
		$this->widgetSchema['fathers_name'] = new sfWidgetFormInputText(array(), array('class' => 'span3', 'placeholder'=>'Enter Fathers Name'));
		$this->widgetSchema['grand_fathers_name'] = new sfWidgetFormInputText(array(), array('class' => 'span3', 'placeholder'=>'Enter Grand Fathers Name'));
		$this->widgetSchema['phone'] = new sfWidgetFormInputText(array(), array('class' => 'span3', 'placeholder'=>'Enter Phone No'));
		$this->widgetSchema['alternate_email'] = new sfWidgetFormInputText(array(), array('class' => 'span3', 'placeholder'=>'Enter Alternative Mail'));


		$this->widgetSchema->setLabels(array(
			'name' => 'Name:',			
			'fathers_name' => 'Father Name:',			
			'grand_fathers_name' => 'Grand Father Name:',			
			'phone' => 'Phon No:',			
			'status' => 'Status:',			
			'Alternate_main' => 'Alternative Mail:',			
			'email_quota' => 'Email Quota:',
			'title' => 'Title:',	
			'avatar_file' => 'Avatar:',			
			'type_of_employment' => 'Employment Type:',			
			'employee_status' => 'Employee Status:',
			'description' => 'Description:'
			));

		if (!$this->isNew()) {   // Embeding only when editing 
			$user = $this->getObject();
			
			// EMBED SAMBA FORM
			foreach ($user->getSambaAccounts() as $samba_account) {
				$this->embedForm('samba_account-' . $samba_account->getId(),  // name
				new EmbeddedSambaAccountForm($samba_account));  // form
			}		
			
			$new_sambaaccount_form = new EmbeddedSambaAccountForm();
			$new_sambaaccount_form->setDefault('user_id', $user->getId());
			$this->embedForm('new_samba_account', $new_sambaaccount_form);


			// EMBED FTP FORM
			foreach ($user->getFtpAccounts() as $ftp_account) {
				$this->embedForm('ftp_account-' . $ftp_account->getId(),  // name
				new EmbeddedFtpAccountForm($ftp_account));  // form
			}		

			if(count($user->getFtpAccounts()) == 0){
				$new_ftpaccount_form = new EmbeddedFtpAccountForm();
				$new_ftpaccount_form->setDefault('user_id', $user->getId());
				$this->embedForm('new_ftp_account', $new_ftpaccount_form);
			}

	
			// EMBED UNIX FORM
			foreach ($user->getUnixAccounts() as $unix_account) {
				$this->embedForm('unix_account-' . $unix_account->getId(),  // name
				new EmbeddedUnixAccountForm($unix_account));  // form
			}		
			
			$new_unixaccount_form = new EmbeddedUnixAccountForm();
			$new_unixaccount_form->setDefault('user_id', $user->getId());
			$this->embedForm('new_unix_account', $new_unixaccount_form);

			
		}	
	}

	public function bind(array $taintedValues = null, array $taintedFiles = null) {  
		// remove the embedded new form if the name field was not provided  
		if (is_null($taintedValues['new_samba_account']['hostname']) || strlen($taintedValues['new_samba_account']['hostname']) === 0 ) {    
			unset($this->embeddedForms['new_samba_account'], $taintedValues['new_samba_account']);  
			$this->validatorSchema['new_samba_account'] = new sfValidatorPass();  
		}  

		if (is_null($taintedValues['new_unix_account']['hostname']) || strlen($taintedValues['new_unix_account']['hostname']) === 0 ) {    
			unset($this->embeddedForms['new_unix_account'], $taintedValues['new_unix_account']);  
			$this->validatorSchema['new_unix_account'] = new sfValidatorPass();  
		}  

		// call parent bind method  
		parent::bind($taintedValues, $taintedFiles);    
	}
}

