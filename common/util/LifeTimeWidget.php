<?php

namespace auvtime\widget;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
/**
 * 
 * <p><b>标题：</b>auvtime\widget$LifeTimeWidget.</p>
 *
 * <p><b>描述：把用户生命长度显示放在widget里</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-18 下午8:49:38
 *
 * @since 1.0
 */
class LifeTimeWidget extends Widget {
	public $user;
	public function init() {
		parent::init ();
		// 如果用户为空，则获取当前登录用户
		if (empty($this->user)) {
			$this->user = Yii::$app->user->identity;
		}
		echo Html::beginTag ( 'div',['class'=>'life-time-container']) . "\n";
	}
	public function run() {
		echo Html::input('hidden','timeUnit',$this->user->time_unit,['id'=>'timeUnit']);
		echo Html::input('hidden','lifeTimeFull',$this->user->getLifeTimeDisplayFull(),['id'=>'lifeTimeFull']);
		echo Html::beginTag('div',['class'=>'life-time','id'=>'lifeTime']);
		echo Html::encode($this->user->getLifeTimeDisplay());
		echo Html::endTag ( 'div' ) . "\n";
		echo Html::endTag ( 'div' ) . "\n";
	}
}