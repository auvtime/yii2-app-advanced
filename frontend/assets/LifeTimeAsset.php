<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 *
 *
 *
 * <p><b>标题：</b>frontend\assets$LifeTimeAsset.</p>
 *
 * <p><b>描述：生命长度页面所用css和js</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-17 下午9:23:02
 *        
 * @since 1.0
 */
class LifeTimeAsset extends AssetBundle {
	public $language;
	public $sourcePath = '@app/auvtime/lifetime';
	public $js = [ ];
	public $css = [ 
			'lifetime.css' 
	];
	public $depends = [ 
			'frontend\assets\AppAsset' 
	];
	public function registerAssetFiles($view) {
		$language = $this->language ? $this->language : Yii::$app->language;
		$this->js [] = 'lifetime-' . $language . '.js';
		parent::registerAssetFiles ( $view );
	}
}
