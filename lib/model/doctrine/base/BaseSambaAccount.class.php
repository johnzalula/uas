<?php

/**
 * BaseSambaAccount
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property string $hostname
 * @property User $User
 * 
 * @method integer      getUserId()   Returns the current record's "user_id" value
 * @method string       getHostname() Returns the current record's "hostname" value
 * @method User         getUser()     Returns the current record's "User" value
 * @method SambaAccount setUserId()   Sets the current record's "user_id" value
 * @method SambaAccount setHostname() Sets the current record's "hostname" value
 * @method SambaAccount setUser()     Sets the current record's "User" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseSambaAccount extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('samba_account');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('hostname', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));


        $this->index('account', array(
             'fields' => 
             array(
              0 => 'user_id',
              1 => 'hostname',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}