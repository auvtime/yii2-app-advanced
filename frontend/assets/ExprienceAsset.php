<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 *
 *
 * <p><b>标题：</b>frontend\assets$ExprienceAsset.</p>
 *
 * <p><b>描述：我的经历</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-5-31 下午9:31:44
 *        
 * @since 1.0
 */
class ExprienceAsset extends AssetBundle {
	public $language;
	public $sourcePath = '@app/auvtime/exprience';
	public $js = [ ];
	public $css = [ 
			'exprience.css' 
	];
	public $depends = [ 
			'frontend\assets\AppAsset',
			'frontend\assets\My97DatePickerAsset' 
	];
	public function registerAssetFiles($view) {
		$language = $this->language ? $this->language : Yii::$app->language;
		$this->js [] = 'exprience-' . $language . '.js';
		parent::registerAssetFiles ( $view );
	}
}