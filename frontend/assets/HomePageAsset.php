<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * 
 * <p><b>标题：</b>frontend\assets$HomePageAsset.</p>
 *
 * <p><b>描述：首页css</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-13 下午10:47:24
 *
 * @since 1.0
 */
class HomePageAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [ 
			'css/homePage.css' 
	];
	public $js = [ ];
	public $depends = [ 
			'yii\web\YiiAsset',
			'yii\bootstrap\BootstrapAsset' 
	];
}
