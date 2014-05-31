<?php
namespace common\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\base\Formatter;
use yii;
use yii\base\Exception;
use yii\web\HttpException;
use Datetime;
use auvtime\util\AuvArrayUtil;
use DateInterval;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $birthday
 * @property string $public_flag
 * @property string $leave_age
 * @property string $time_unit
 * @property string $mobile
 * @property string $face
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $create_time
 * @property string $update_time
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_USER = 10;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'mytimestamp' => [
            	'class' => TimestampBehavior::className(),
            	'attributes' => [
           			ActiveRecord::EVENT_BEFORE_INSERT => 'create_time',
            		ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
           		 ],
            	'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
      * @inheritdoc
      */
     public function rules()
     {
     	 $mobilePattern = '/^13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$|14[57]{1}[0-9]$/';
         return [
             ['status', 'default', 'value' => self::STATUS_ACTIVE],
             ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

             ['role', 'default', 'value' => self::ROLE_USER],
             ['role', 'in', 'range' => [self::ROLE_USER]],
             
             [['username', 'auth_key', 'password_hash', 'email'], 'required'],
             [['leave_age', 'role', 'status', 'created_at', 'updated_at'], 'integer'],
             [['create_time', 'update_time'], 'safe'],
             [['username', 'nickname', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
             [['public_flag'], 'string', 'max' => 10],
             [['time_unit'], 'string', 'max' => 20],
             [['mobile'], 'string', 'max' => 120],
             [['face'], 'string', 'max' => 1000],
             [['auth_key'], 'string', 'max' => 32],
             [['username'], 'unique'],
             [['email'],'email'],
             [['mobile'],'match','pattern'=>$mobilePattern,'message'=>Yii::t('auvtime', 'Please input a valid mobile phone number.')],
         ];
     }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Security::validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    /**
     * 获取生命长度显示
     * 
     * @author WangXianfeng 2014-5-16 下午4:32:26
     */
    public function getLifeTimeDisplay(){
    	$lifeTimeDisplay = '';
    	try{
	    	$userName = $this->username;
	    	if($this->nickname){
	    		$userName = $this->nickname;
	    	}
	    	$birthday = $this->getUserBirthDay();
	    	$lifeTime = $this->getLifeTime($this->time_unit,$this->birthday);
	    	Yii::info($lifeTime,'auvtime');
	    	$lifeTimeInDays = $this->getLifeTimeInDays($this->time_unit,$this->birthday);
	    	$lifeTimeDisplay = $lifeTime.','.$lifeTimeInDays.'.';
    	}catch(Exception $e){
    		Yii::error('@@@error occurs when get life time display,error code is '.$e->getName(),'auvtime');
    		throw new HttpException('500', 'error occurs when get life time display');
    	}
    	return $lifeTimeDisplay;
    }
    
    
    /**
     * 根据用户生命单位，获取用户生日字符串
     * 
     * @author WangXianfeng 2014-5-16 下午4:36:53
     */
    public function getUserBirthDay(){
    	$format = new Formatter();
    	$userBirthDay = $this->birthday;
    	Yii::info('@@@user\'s birthday is '.$userBirthDay,'auvtime');
    	$userBirthDayFormat = $format->format($userBirthDay, ['date','Y-m-d']);
    	$userTimeUnit = $this->time_unit;
    	if($userTimeUnit === 'YEAR'){
    		$userBirthDayFormat = $format->format($userBirthDay, ['date','Y']);
    	}elseif ($userTimeUnit === 'MONTH'){
    		$userBirthDayFormat = $format->format($userBirthDay, ['date','Y-m']);
    	}elseif ($userTimeUnit === 'DAY'){
    		$userBirthDayFormat = $format->format($userBirthDay, ['date','Y-m-d']);
    	}elseif ($userTimeUnit === 'HOUR'){
    		$userBirthDayFormat = $format->format($userBirthDay, ['date','Y-m-d H']);
    	}elseif ($userTimeUnit === 'MINUTE'){
    		$userBirthDayFormat = $format->format($userBirthDay, ['date','Y-m-d H:i']);
    	}elseif ($userTimeUnit === 'SECOND'){
    		$userBirthDayFormat = $format->format($userBirthDay, ['date','Y-m-d H:i:s']);
    	}
    	Yii::info('@@@user\'s birthday format is '.$userBirthDayFormat,'auvtime');
    	return $userBirthDayFormat;
    }
    
    /**
     * 根据用户生命单位返回用户年龄字符串
     * 
     * @param string $timeUnit
     * @param string $birthday
     * @param string $end
     * @return string
     * @author WangXianfeng 2014-5-17 下午1:07:19
     */
    public function getLifeTime($timeUnit,$birthday, $end = null) {
		if (! ($birthday instanceof DateTime)) {
			$birthday = new DateTime ( $birthday );
		}
		
		if ($end === null) {
			$end = new DateTime ();
		}
		if (! ($end instanceof DateTime)) {
			$end = new DateTime ( $end );
		}
		Yii::info('@@@When get user\'s life time,the system time is:'.$end->format('Y-m-d H:i:s'),'auvtime');
		$interval = $end->diff ( $birthday );
		$doPlural = function ($nb, $str) {
			return $nb > 1 ? $str . 's ' : $str.' ';
		}; // adds plurals
		
		$format = array ();
		if ($interval->y !== 0) {
			$format [] = "%y" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->y, " year" ));
		}
		if ($interval->m !== 0) {
			$format [] = "%m" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->m, " month" ));
		}
		if ($interval->d !== 0) {
			$format [] = "%d" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->d, " day" ));
		}
		if ($interval->h !== 0) {
			$format [] = "%h" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->h, " hour" ));
		}
		if ($interval->i !== 0) {
			$format [] = "%i" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->i, " minute" ));
		}
		if ($interval->s !== 0) {
			$interval->s = $interval->s + 1;
			if (! count ( $format )) {
				return \Yii::t('auvtim-lifetime', 'less than a minute ago.');
			} else {
				$format [] = "%s" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->s, " second" ));
			}
		}
		//根据生命单位返回生命长度
		$jsonFormat = AuvArrayUtil::array_to_json_string($format);
		Yii::info('@@@user life time json format:'.$jsonFormat,'auvtime');
		Yii::info('@@@user time unit:'.$timeUnit,'auvtime');
		//根据用户生命单位和格式化字符串获取最终的格式化字符串
		$format = $this->getUserLifeTimeFormat($timeUnit,$format,$jsonFormat);
		Yii::info('@@@user life time final format:'.$format,'auvtime');
		// Prepend 'since ' or whatever you like
		return $interval->format ( $format );
	}
	/**
	 * 根据用户生命单位和格式化字符串获取最终的格式化字符串
	 *
	 * @param string $timeUnit        	
	 * @param array $format        	
	 * @param string $jsonFormat        	
	 * @author WangXianfeng 2014-5-18 上午8:05:21
	 */
	private function getUserLifeTimeFormat($timeUnit, $format, $jsonFormat) {
		$lifeTimeFormat = '';
		if ($timeUnit === 'YEAR' && stripos ( $jsonFormat, '%y' ) > 0) {
			$lifeTimeFormat = array_shift ( $format );
		} elseif ($timeUnit === 'MONTH') {
			if (stripos ( $jsonFormat, '%y' ) > 0) {
				$lifeTimeFormat = array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%m' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
		} elseif ($timeUnit === 'DAY') {
			if (stripos ( $jsonFormat, '%y' ) > 0) {
				$lifeTimeFormat = array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%m' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%d' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
		} elseif ($timeUnit === 'HOUR') {
			if (stripos ( $jsonFormat, '%y' ) > 0) {
				$lifeTimeFormat = array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%m' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%d' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%h' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
		} elseif ($timeUnit === 'MINUTE') {
			if (stripos ( $jsonFormat, '%y' ) > 0) {
				$lifeTimeFormat = array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%m' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%d' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%h' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%i' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
		} elseif ($timeUnit === 'SECOND') {
			if (stripos ( $jsonFormat, '%y' ) > 0) {
				$lifeTimeFormat = array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%m' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%d' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%h' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%i' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
			if (stripos ( $jsonFormat, '%s' ) > 0) {
				$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
			}
		}
		return $lifeTimeFormat;
	}
	
	/**
	 * 以总天数表示年龄
	 * 
	 * @param string $timeUnit
	 * @param DateTime $birthday
	 * @param DateTime $end
	 * @return string
	 * @author WangXianfeng 2014-5-18 上午11:56:23
	 */
	public function getLifeTimeInDays($timeUnit,$birthday, $end = null){
		if (! ($birthday instanceof DateTime)) {
			$birthday = new DateTime ( $birthday );
		}
		
		if ($end === null) {
			$end = new DateTime ();
		}
		if (! ($end instanceof DateTime)) {
			$end = new DateTime ( $end );
		}
		$doPlural = function ($nb, $str) {
			return $nb > 1 ? $str . 's' : $str;
		}; // adds plurals
		Yii::info('@@@When get user\'s life time in days,the system time is:'.$end->format('Y-m-d H:i:s'),'auvtime');
		$interval = $end->diff ( $birthday );
		$lifeTimeInDays = $interval->days;
		$lifeTimeInDays = $lifeTimeInDays.\Yii::t('auvtime-lifetime', $doPlural ( $lifeTimeInDays," day" ));
		Yii::info('@@@When get user\'s life time in days,the $passTime  is:'.$lifeTimeInDays,'auvtime');
		return $lifeTimeInDays;
	}
	
	/**
	 * 获取用户生命长度信息全部显示
	 *
	 * @throws HttpException
	 * @return string
	 * @author WangXianfeng 2014-5-18 下午4:28:01
	 */
	public function getLifeTimeDisplayFull(){
		$lifeTimeDisplay = '';
		try{
			$userName = $this->username;
			if($this->nickname){
				$userName = $this->nickname;
			}
			$birthday = $this->getUserBirthDay();
			$lifeTime = $this->getLifeTimeFull($this->time_unit,$this->birthday);
			$lifeTimeInDays = $this->getLifeTimeInDays($this->time_unit,$this->birthday);
			$lifeTimeDisplay = $lifeTime.','.$lifeTimeInDays.'.';
		}catch(Exception $e){
			Yii::error('@@@error occurs when get life time display,error code is '.$e->getName(),'auvtime');
			throw new HttpException('500', 'error occurs when get life time display');
		}
		return $lifeTimeDisplay;
	}
	
	/**
	 * 获取所有年月日时分秒
	 * 
	 * @param string $timeUnit
	 * @param DataTime $birthday
	 * @param DataTime $end
	 * @return string
	 * @author WangXianfeng 2014-5-18 下午4:29:18
	 */
	public function getLifeTimeFull($timeUnit, $birthday, $end = null) {
		if (! ($birthday instanceof DateTime)) {
			$birthday = new DateTime ( $birthday );
		}
		
		if ($end === null) {
			$end = new DateTime ();
		}
		if (! ($end instanceof DateTime)) {
			$end = new DateTime ( $end );
		}
		Yii::info ( '@@@When get user\'s life time,the system time is:' . $end->format ( 'Y-m-d H:i:s' ), 'auvtime' );
		$interval = $end->diff ( $birthday );
		$doPlural = function ($nb, $str) {
			return $nb > 1 ? $str . 's ' : $str . ' ';
		}; // adds plurals
		$interval->s = $interval->s + 1;
		$format = array ();
		$format [] = "%y" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->y, " year" ) );
		
		$format [] = "%m" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->m, " month" ) );
		
		$format [] = "%d" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->d, " day" ) );
		
		$format [] = "%h" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->h, " hour" ) );
		
		$format [] = "%i" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->i, " minute" ) );
		
		$format [] = "%s" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->s, " second" ) );
		
		// 根据生命单位返回生命长度
		$jsonFormat = AuvArrayUtil::array_to_json_string ( $format );
		Yii::info ( '@@@user life time json format:' . $jsonFormat, 'auvtime' );
		Yii::info ( '@@@user time unit:' . $timeUnit, 'auvtime' );
		// 根据用户生命单位和格式化字符串获取最终的格式化字符串
		$format = $this->getUserLifeTimeFullFormat ( $timeUnit, $format, $jsonFormat );
		Yii::info ( '@@@user life time final format:' . $format, 'auvtime' );
		// Prepend 'since ' or whatever you like
		return $interval->format ( $format );
	}
	/**
	 * 获取年与日时分秒
	 * 
	 * @param string $timeUnit
	 * @param array $format
	 * @param string $jsonFormat
	 * @return string
	 * @author WangXianfeng 2014-5-18 下午4:32:26
	 */
	private function getUserLifeTimeFullFormat($timeUnit, $format, $jsonFormat) {
		$lifeTimeFormat = '';
		for($i = 0;$i<6;$i++){
			$lifeTimeFormat = $lifeTimeFormat . array_shift ( $format );
		}
		return $lifeTimeFormat;
	}
	
	/**
	 * 
	 * 
	 * @throws HttpException
	 * @return string
	 * @author WangXianfeng 2014-5-19 下午9:45:21
	 */
	public function getLeaveTimeDisplayFull(){
		$leaveTimeDisplay = '';
		try{
			$userName = $this->username;
			if($this->nickname){
				$userName = $this->nickname;
			}
			$birthday = $this->getUserBirthDay();
			$leaveTime = $this->getLeaveTimeFull($this->time_unit,$this->birthday);
			Yii::info('The leave time for user is :'.$leaveTime,'auvtime');
			$leaveTimeInDays = $this->getLeaveTimeInDays($this->time_unit,$this->birthday);
			$leaveTimeDisplay = $leaveTime.','.$leaveTimeInDays.'.';
		}catch(Exception $e){
			Yii::error('@@@error occurs when get leave time display','auvtime');
			throw new HttpException('500', 'error occurs when get leave time display');
		}
		return $leaveTimeDisplay;
	}
	/**
	 * 
	 * 
	 * @param sting $timeUnit
	 * @param DateTime $birthday
	 * @param DateTime $end
	 * @return string
	 * @author WangXianfeng 2014-5-19 下午10:18:13
	 */
	public function getLeaveTimeFull($timeUnit, $birthday, $end = null) {
		$nowTime = new DateTime();
		if (! ($birthday instanceof DateTime)) {
			$birthday = new DateTime ( $birthday );
		}
		$userLeaveAge = new DateInterval('P'.$this->leave_age.'Y');
		
		if ($end === null) {
			$end = $birthday->add($userLeaveAge);
		}
		if(!$end instanceof DateTime){
			$end = new DateTime($end);
		}
		Yii::info ( '@@@When get user\'s leave time,the system time is:' . $nowTime->format ( 'Y-m-d H:i:s' ), 'auvtime' );
		Yii::info ( '@@@When get user\'s leave time,the final time is:' . $end->format ( 'Y-m-d H:i:s' ), 'auvtime' );
		$interval = $end->diff ( $nowTime );
		$doPlural = function ($nb, $str) {
			return $nb > 1 ? $str . 's ' : $str . ' ';
		}; // adds plurals
		$interval->s = $interval->s + 1;
		$format = array ();
		$format [] = "%y" . \Yii::t ( 'auvtime-leavetime', $doPlural ( $interval->y, " year" ) );
	
		$format [] = "%m" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->m, " month" ) );
	
		$format [] = "%d" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->d, " day" ) );
	
		$format [] = "%h" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->h, " hour" ) );
	
		$format [] = "%i" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->i, " minute" ) );
	
		$format [] = "%s" . \Yii::t ( 'auvtime-lifetime', $doPlural ( $interval->s, " second" ) );
	
		// 根据用户生命单位和格式化字符串获取最终的格式化字符串
		$format = $this->getUserLifeTimeFullFormat ( $timeUnit, $format, null );
		Yii::info ( '@@@user leave time final format:' . $format, 'auvtime' );
		// Prepend 'since ' or whatever you like
		return $interval->format ( $format );
	}
	/**
	 * 获取离开天数
	 * 
	 * @return string
	 * @author WangXianfeng 2014-5-24 下午9:31:57
	 */
	public function getLeaveTimeDays(){
		return $this->getLeaveTimeInDays($this->time_unit,$this->birthday);
	}
	/**
	 * 获取离开天数
	 * 
	 * @param string $timeUnit
	 * @param DateTime $birthday
	 * @param DateTime $end
	 * @return string
	 * @author WangXianfeng 2014-5-24 下午9:32:02
	 */
	public function getLeaveTimeInDays($timeUnit,$birthday, $end = null){
		$nowTime = new DateTime();
		if (! ($birthday instanceof DateTime)) {
			$birthday = new DateTime ( $birthday );
		}
		$userLeaveAge = new DateInterval('P'.$this->leave_age.'Y');
		
		if ($end === null) {
			$end = $birthday->add($userLeaveAge);
		}
		if(!$end instanceof DateTime){
			$end = new DateTime($end);
		}
		$interval = $end->diff ( $nowTime );
		$doPlural = function ($nb, $str) {
			return $nb > 1 ? $str . 's' : $str;
		}; // adds plurals
		$leaveTimeInDays = $interval->days;
		$leaveTimeInDays = $leaveTimeInDays.\Yii::t('auvtime-lifetime', $doPlural ( $leaveTimeInDays," day" ));
		Yii::info('@@@When get user\'s leave time in days,the $passTime  is:'.$leaveTimeInDays,'auvtime');
		return $leaveTimeInDays;
	}
	/**
	 * 获取离开时间前台展示字符串
	 * 
	 * @throws HttpException
	 * @return string
	 * @author WangXianfeng 2014-5-20 上午11:23:45
	 */
	public function getLeaveTimeDisplay(){
		$leaveTimeDisplay = '';
		try{
			$userName = $this->username;
			if($this->nickname){
				$userName = $this->nickname;
			}
			$birthday = $this->getUserBirthDay();
			$leaveTime = $this->getLeaveTime($this->time_unit,$this->birthday);
			Yii::info($leaveTime,'auvtime');
			$leaveTimeInDays = $this->getLeaveTimeInDays($this->time_unit,$this->birthday);
			$leaveTimeDisplay = $leaveTime.','.$leaveTimeInDays.'.';
		}catch(Exception $e){
			Yii::error('@@@error occurs when get life time display,error code is '.$e->getName(),'auvtime');
			throw new HttpException('500', 'error occurs when get life time display');
		}
		return $leaveTimeDisplay;
	}
	/**
	 * 获取离开时间
	 * 
	 * @param string $timeUnit
	 * @param DateTime $birthday
	 * @param DateTime $end
	 * @return string|Ambigous <string, string, boolean, unknown>
	 * @author WangXianfeng 2014-5-20 上午11:25:18
	 */
	public function getLeaveTime($timeUnit,$birthday, $end = null) {
		$nowTime = new DateTime();
		if (! ($birthday instanceof DateTime)) {
			$birthday = new DateTime ( $birthday );
		}
		$userLeaveAge = new DateInterval('P'.$this->leave_age.'Y');
		
		if ($end === null) {
			$end = $birthday->add($userLeaveAge);
		}
		if(!$end instanceof DateTime){
			$end = new DateTime($end);
		}
		$interval = $end->diff ( $nowTime );
		$doPlural = function ($nb, $str) {
			return $nb > 1 ? $str . 's ' : $str.' ';
		}; // adds plurals
	
		$format = array ();
		if ($interval->y !== 0) {
			$format [] = "%y" . \Yii::t('auvtime-leavetime', $doPlural ( $interval->y, " year" ));
		}
		if ($interval->m !== 0) {
			$format [] = "%m" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->m, " month" ));
		}
		if ($interval->d !== 0) {
			$format [] = "%d" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->d, " day" ));
		}
		if ($interval->h !== 0) {
			$format [] = "%h" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->h, " hour" ));
		}
		if ($interval->i !== 0) {
			$format [] = "%i" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->i, " minute" ));
		}
		if ($interval->s !== 0) {
			$interval->s = $interval->s + 1;
			if (! count ( $format )) {
				return \Yii::t('auvtim-lifetime', 'less than a minute ago.');
			} else {
				$format [] = "%s" . \Yii::t('auvtime-lifetime', $doPlural ( $interval->s, " second" ));
			}
		}
		//根据生命单位返回生命长度
		$jsonFormat = AuvArrayUtil::array_to_json_string($format);
		Yii::info('@@@user leave time json format:'.$jsonFormat,'auvtime');
		Yii::info('@@@user leave unit:'.$timeUnit,'auvtime');
		//根据用户生命单位和格式化字符串获取最终的格式化字符串
		$format = $this->getUserLifeTimeFormat($timeUnit,$format,$jsonFormat);
		Yii::info('@@@user leave time final format:'.$format,'auvtime');
			// Prepend 'since ' or whatever you like
		return $interval->format ( $format );
	}
	
	/**
	 * 设置中文标签
	 * 
	 * @see \yii\base\Model::attributeLabels()
	 * @return multitype:string Ambigous <string, string, boolean, unknown>
	 * @author WangXianfeng 2014-5-25 下午8:11:09
	 */
	public function attributeLabels() {
		$usernameLabel = \Yii::t ( 'auvtime-myprofile', 'Username' );
		$nicknameLabel = \Yii::t ( 'auvtime-myprofile', 'Nickname' );
		$birthdayLabel = \Yii::t ( 'auvtime-myprofile', 'Birthday' );
		$publicFlagLabel = \Yii::t ( 'auvtime-myprofile', 'Public Flag' );
		$leaveAgeLabel = \Yii::t ( 'auvtime-myprofile', 'Leave Age' );
		$timeUnitLabel = \Yii::t ( 'auvtime-myprofile', 'Time Unit' );
		$mobileLabel = \Yii::t ( 'auvtime-myprofile', 'Mobile' );
		$faceLabel = \Yii::t ( 'auvtime-myprofile', 'Face' );
		$emailLabel = \Yii::t ( 'auvtime-myprofile', 'Email' );
		$createTimeLabel = \Yii::t ( 'auvtime-myprofile', 'Create Time' );
		$updateTimeLabel = \Yii::t ( 'auvtime-myprofile', 'Update Time' );
		return [ 
				'username' => $usernameLabel,
				'nickname' => $nicknameLabel,
				'birthday' => $birthdayLabel,
				'public_flag' => $publicFlagLabel,
				'leave_age' => $leaveAgeLabel, 
				'time_unit' => $timeUnitLabel,
				'mobile' => $mobileLabel,
				'face' => $faceLabel,
				'email' => $emailLabel,
				'create_time' => $createTimeLabel,
				'update_time' => $updateTimeLabel
		];
	}
	/**
	 * 是否公开标识
	 * 
	 * @author WangXianfeng 2014-5-25 下午8:53:03
	 */
	public function getPublicFlagOptions(){
		return [
			'0' => '不公开',
			'1' => '公开',
		];
	}
	/**
	 * 获取时间单位选项
	 * 
	 * @author WangXianfeng 2014-5-26 下午9:23:05
	 */
	public function getTimeUnitOptions(){
		return [
			'SECOND' => '秒',
			'MINUTE' => '分钟',
			'HOUR' => '小时',
			'DAY' => '天',
			'MONTH' => '月',
			'YEAR' => '年',
		];
	}
	
	/**
	 * 验证手机号码是否合法
	 * 
	 * @param string $attribute 属性
	 * @author WangXianfeng 2014-5-26 下午9:49:04
	 */
	public function validateMobile($attribute,$params) {
		$value = $this->$attribute;
		Yii::info('The user\'s mobile is '.$value);
		$exp = "/^13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$|14[57]{1}[0-9]$/";
		if (!preg_match ( $exp, $value )) {
			$this->addError($attribute,\Yii::t('auvtime', 'Please input a valid mobile phone number.'));
		}
	}
}
