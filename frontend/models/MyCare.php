<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\base\Formatter;
use yii\base\Exception;
use yii\web\HttpException;
use auvtime\util\AuvArrayUtil;
use Datetime;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "my_care".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $order_num
 * @property string $nick_name
 * @property string $relationship
 * @property string $solar_birthday
 * @property string $lunar_birthday
 * @property string $remark
 * @property string $create_time
 * @property string $update_time
 */
class MyCare extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_care';
    }
    /**
     * 我关心的人创建时间和更新时间
     * @see \yii\base\Component::behaviors()
     * @return multitype:multitype:multitype:string
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-3 下午4:50:48
     */
    public function behaviors() {
		return [ 
				'timestamp' => [ 
						'class' => TimestampBehavior::className (),
						'attributes' => [ 
								ActiveRecord::EVENT_BEFORE_INSERT => 'create_time',
								ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time' 
						],
						'value' => new Expression ( 'NOW()' ) 
				] 
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'relationship','solar_birthday','lunar_birthday'], 'required'],
            [['user_id','order_num'], 'integer'],
            [['solar_birthday', 'lunar_birthday', 'create_time', 'update_time'], 'safe'],
            [['name', 'nick_name', 'relationship'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('my-care', 'ID'),
            'user_id' => Yii::t('my-care', 'User ID'),
            'name' => Yii::t('my-care', 'Name'),
            'nick_name' => Yii::t('my-care', 'Nick Name'),
            'relationship' => Yii::t('my-care', 'Relationship'),
            'solar_birthday' => Yii::t('my-care', 'Solar Birthday'),
            'lunar_birthday' => Yii::t('my-care', 'Lunar Birthday'),
            'remark' => Yii::t('my-care', 'Remark'),
            'create_time' => Yii::t('my-care', 'Create Time'),
            'update_time' => Yii::t('my-care', 'Update Time'),
        ];
    }
    
    /**
     * 获取关心的人的生日(暂时以阳历生日为准)
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-3 下午7:38:09
     */
    public function getMyCaredPersonsBirthday(){
    	$format = new Formatter();
    	$birtyday = $this->solar_birthday;
    	$birthDayFormat = $format->format($birtyday, ['date','Y-m-d']);
    	Yii::info('$birthDayFormat:'.$birthDayFormat,'auvtime');
    	return $birthDayFormat;
    }
    /**
     * 获取关心的人的年龄
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-3 下午7:41:30
     */
    public function getMyCaredPersonsAge(){
    	$ageDisplay = '';
    	try{
    		$userName = $this->name;
    		if($this->nick_name){
    			$userName = $this->nick_name;
    		}
    		$age = $this->getAge($this->solar_birthday);
    		
    		$ageInDays = $this->getAgeInDays($this->solar_birthday);
    		$ageDisplay = $age.','.$ageInDays.'.';
    		Yii::info($ageDisplay,'auvtime');
    	}catch(Exception $e){
    		throw new HttpException('500', 'error occurs when get person\'s age.');
    	}
    	return $ageDisplay;
    }
    /**
     * 获取年龄
     * 
     * @param DateTime $birthday
     * @param DateTime $end
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-3 下午7:51:44
     */
    private function getAge($birthday, $end = null){
    	if (! ($birthday instanceof DateTime)) {
    		$birthday = new DateTime ( $birthday );
    	}
    	
    	if ($end === null) {
    		$end = new DateTime ();
    	}
    	if (! ($end instanceof DateTime)) {
    		$end = new DateTime ( $end );
    	}
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
    	//根据生命单位返回生命长度
    	$jsonFormat = AuvArrayUtil::array_to_json_string($format);
    	$ageFormat = '';
    	if (stripos ( $jsonFormat, '%y' ) > 0) {
    		$ageFormat = array_shift ( $format );
    	}
    	if (stripos ( $jsonFormat, '%m' ) > 0) {
    		$ageFormat = $ageFormat . array_shift ( $format );
    	}
    	if (stripos ( $jsonFormat, '%d' ) > 0) {
    		$ageFormat = $ageFormat . array_shift ( $format );
    	}
    	return $interval->format ( $ageFormat );
    }
    /**
     * 获取年龄天数
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-3 下午8:03:01
     */
    private function getAgeInDays($birthday, $end = null){
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
    	$interval = $end->diff ( $birthday );
    	$ageInDays = $interval->days;
    	$ageInDays = $ageInDays.\Yii::t('auvtime-lifetime', $doPlural ( $ageInDays," day" ));
    	Yii::info('@@@When get my cared person\'s age in days,the $passTime  is:'.$ageInDays,'auvtime');
    	return $ageInDays;
    }
}
