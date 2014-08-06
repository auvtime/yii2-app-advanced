<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 *
 * <p><b>标题：</b>frontend\assets$JQueryUIAsset.</p>
 *
 * <p><b>描述：jquery ui</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-15 上午11:14:47
 *        
 * @since 1.0
 */
class JQueryUIAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/jqueryui';
	public $js = [ 
			'jquery-ui.min.js' 
	];
	public $depends = [ 
			'yii\web\JqueryAsset' 
	];
	public $css = [ 
			'jquery-ui.css' 
	];
	public $cssOptions = [ 
			'id' => 'theme' 
	];
}
