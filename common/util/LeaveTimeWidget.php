<?php

namespace auvtime\widget;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
/**
 * 
 * <p><b>标题：</b>auvtime\widget$LeaveTimeWidget.</p>
 *
 * <p><b>描述：剩余时间widget</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-19 下午9:38:48
 *
 * @since 1.0
 */
class LeaveTimeWidget extends Widget {
	public $user;
	public function init() {
		parent::init ();
		// 如果用户为空，则获取当前登录用户
		if (empty($this->user)) {
			$this->user = Yii::$app->user->identity;
		}
		echo Html::beginTag ( 'div',['class'=>'leave-time-container']) . "\n";
	}
	public function run() {
		echo Html::input('hidden','timeUnit',$this->user->time_unit,['id'=>'timeUnit']);
		echo Html::input('hidden','leaveTimeFull',$this->user->getLeaveTimeDisplayFull(),['id'=>'leaveTimeFull']);
		echo Html::beginTag('div',['class'=>'leave-time','id'=>'leaveTime']);
		echo Html::encode($this->user->getLeaveTimeDisplay());
		echo Html::endTag ( 'div' ) . "\n";
		echo Html::beginTag('div',['class'=>'countdown','id'=>'countdown']);
		echo Html::endTag('div')."\n";
		echo Html::endTag ( 'div' ) . "\n";
	}
}