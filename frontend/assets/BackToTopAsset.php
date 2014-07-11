<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * 
 * <p><b>标题：</b>frontend\assets$BackToTopAsset.</p>
 *
 * <p><b>描述：返回顶部js和css</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-7-11 下午5:46:09
 *
 * @since 1.0
 */
class BackToTopAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/backtotop';
	public $js = [ 
			'backtotop.js' 
	];
	public $css = [ 
			'backtotop.css' 
	];
	public $depends = [ 
			'frontend\assets\AppAsset'
	];
}
