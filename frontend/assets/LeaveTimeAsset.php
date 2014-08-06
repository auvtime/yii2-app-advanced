<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * 
 * <p><b>标题：</b>frontend\assets$LeaveTimeAsset.</p>
 *
 * <p><b>描述：生命倒计时页面css和js</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-23 上午9:18:57
 *
 * @since 1.0
 */
class LeaveTimeAsset extends AssetBundle {
	public $language;
	public $sourcePath = '@app/auvtime/leavetime';
	public $js = [ ];
	public $css = [ 
			'leavetime.css' 
	];
	public $depends = [ 
			'frontend\assets\AppAsset' 
	];
	public function registerAssetFiles($view) {
		$language = $this->language ? $this->language : Yii::$app->language;
		$this->js [] = 'jquery.countdown.js';
		$this->js [] = 'leavetime-' . $language . '.js';
		parent::registerAssetFiles ( $view );
	}
}
