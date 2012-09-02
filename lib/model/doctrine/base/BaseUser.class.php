<?php

/**
 * BaseUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $domainname_id
 * @property string $name
 * @property string $fathers_name
 * @property string $grand_fathers_name
 * @property string $login
 * @property string $phone
 * @property string $nt_password
 * @property string $lm_password
 * @property string $crypt_password
 * @property string $unix_password
 * @property integer $gid
 * @property integer $uid
 * @property string $status
 * @property string $alternate_email
 * @property string $email_local_part
 * @property string $email_quota
 * @property timestamp $expires_at
 * @property integer $sfguarduser_id
 * @property DomainName $DomainName
 * @property sfGuardUser $sfGuardUser
 * @property Doctrine_Collection $UserIdentifications
 * @property Doctrine_Collection $UnixAccounts
 * @property Doctrine_Collection $FtpAccounts
 * @property Doctrine_Collection $SambaAccounts
 * @property Doctrine_Collection $Comment
 * 
 * @method integer             getDomainnameId()        Returns the current record's "domainname_id" value
 * @method string              getName()                Returns the current record's "name" value
 * @method string              getFathersName()         Returns the current record's "fathers_name" value
 * @method string              getGrandFathersName()    Returns the current record's "grand_fathers_name" value
 * @method string              getLogin()               Returns the current record's "login" value
 * @method string              getPhone()               Returns the current record's "phone" value
 * @method string              getNtPassword()          Returns the current record's "nt_password" value
 * @method string              getLmPassword()          Returns the current record's "lm_password" value
 * @method string              getCryptPassword()       Returns the current record's "crypt_password" value
 * @method string              getUnixPassword()        Returns the current record's "unix_password" value
 * @method integer             getGid()                 Returns the current record's "gid" value
 * @method integer             getUid()                 Returns the current record's "uid" value
 * @method string              getStatus()              Returns the current record's "status" value
 * @method string              getAlternateEmail()      Returns the current record's "alternate_email" value
 * @method string              getEmailLocalPart()      Returns the current record's "email_local_part" value
 * @method string              getEmailQuota()          Returns the current record's "email_quota" value
 * @method timestamp           getExpiresAt()           Returns the current record's "expires_at" value
 * @method integer             getSfguarduserId()       Returns the current record's "sfguarduser_id" value
 * @method DomainName          getDomainName()          Returns the current record's "DomainName" value
 * @method sfGuardUser         getSfGuardUser()         Returns the current record's "sfGuardUser" value
 * @method Doctrine_Collection getUserIdentifications() Returns the current record's "UserIdentifications" collection
 * @method Doctrine_Collection getUnixAccounts()        Returns the current record's "UnixAccounts" collection
 * @method Doctrine_Collection getFtpAccounts()         Returns the current record's "FtpAccounts" collection
 * @method Doctrine_Collection getSambaAccounts()       Returns the current record's "SambaAccounts" collection
 * @method Doctrine_Collection getComment()             Returns the current record's "Comment" collection
 * @method User                setDomainnameId()        Sets the current record's "domainname_id" value
 * @method User                setName()                Sets the current record's "name" value
 * @method User                setFathersName()         Sets the current record's "fathers_name" value
 * @method User                setGrandFathersName()    Sets the current record's "grand_fathers_name" value
 * @method User                setLogin()               Sets the current record's "login" value
 * @method User                setPhone()               Sets the current record's "phone" value
 * @method User                setNtPassword()          Sets the current record's "nt_password" value
 * @method User                setLmPassword()          Sets the current record's "lm_password" value
 * @method User                setCryptPassword()       Sets the current record's "crypt_password" value
 * @method User                setUnixPassword()        Sets the current record's "unix_password" value
 * @method User                setGid()                 Sets the current record's "gid" value
 * @method User                setUid()                 Sets the current record's "uid" value
 * @method User                setStatus()              Sets the current record's "status" value
 * @method User                setAlternateEmail()      Sets the current record's "alternate_email" value
 * @method User                setEmailLocalPart()      Sets the current record's "email_local_part" value
 * @method User                setEmailQuota()          Sets the current record's "email_quota" value
 * @method User                setExpiresAt()           Sets the current record's "expires_at" value
 * @method User                setSfguarduserId()       Sets the current record's "sfguarduser_id" value
 * @method User                setDomainName()          Sets the current record's "DomainName" value
 * @method User                setSfGuardUser()         Sets the current record's "sfGuardUser" value
 * @method User                setUserIdentifications() Sets the current record's "UserIdentifications" collection
 * @method User                setUnixAccounts()        Sets the current record's "UnixAccounts" collection
 * @method User                setFtpAccounts()         Sets the current record's "FtpAccounts" collection
 * @method User                setSambaAccounts()       Sets the current record's "SambaAccounts" collection
 * @method User                setComment()             Sets the current record's "Comment" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user');
        $this->hasColumn('domainname_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('fathers_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('grand_fathers_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('login', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => '50',
             ));
        $this->hasColumn('phone', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('nt_password', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('lm_password', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('crypt_password', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('unix_password', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('gid', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('uid', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'unique' => true,
             ));
        $this->hasColumn('status', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'disactivated',
             'length' => '20',
             ));
        $this->hasColumn('alternate_email', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('email_local_part', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('email_quota', 'string', 32, array(
             'type' => 'string',
             'notnull' => true,
             'default' => '500000S',
             'length' => '32',
             ));
        $this->hasColumn('expires_at', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('sfguarduser_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));


        $this->index('email_address', array(
             'fields' => 
             array(
              0 => 'email_local_part',
              1 => 'domainname_id',
             ),
             'type' => 'unique',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DomainName', array(
             'local' => 'domainname_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardUser', array(
             'local' => 'sfguarduser_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('UserIdentification as UserIdentifications', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('UnixAccount as UnixAccounts', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('FtpAccount as FtpAccounts', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('SambaAccount as SambaAccounts', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('Comment', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}