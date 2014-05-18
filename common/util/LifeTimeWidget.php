<?php
namespace auvtime\widget;
use yii\base\Widget;
class LifeTimeWidget extends Widget{
	private $lifeTimeYear;
	private $lifeTimeMonth;
	private $lifeTimeDay;
	private $lifeTimeHour;
	private $lifeTimeMinute;
	private $lifeTimeSecond;
	public $user;
	public function init(){
		//如果用户为空，则获取当前登录用户
		if(!$user){
			$user = Yii::$app->user->identity;
		}
		
	}
	
	/**
	 * @return the $lifeTimeYear
	 */
	public function getLifeTimeYear() {
		return $this->lifeTimeYear;
	}

	/**
	 * @return the $lifeTimeMonth
	 */
	public function getLifeTimeMonth() {
		return $this->lifeTimeMonth;
	}

	/**
	 * @return the $lifeTimeDay
	 */
	public function getLifeTimeDay() {
		return $this->lifeTimeDay;
	}

	/**
	 * @return the $lifeTimeHour
	 */
	public function getLifeTimeHour() {
		return $this->lifeTimeHour;
	}

	/**
	 * @return the $lifeTimeMinute
	 */
	public function getLifeTimeMinute() {
		return $this->lifeTimeMinute;
	}

	/**
	 * @return the $lifeTimeSecond
	 */
	public function getLifeTimeSecond() {
		return $this->lifeTimeSecond;
	}

}