<?php

class UserIdentificationTable extends Doctrine_Table
{

	static public $access_types = array(
		'staff_id' => 'Staff ID',
		'student_id' => 'Student ID'
		);
	
	static public function getAccessTypes() 
	{
		return self::$access_types;
	}
}
