<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 *
 *
 * <p><b>标题：</b>frontend\assets$ClockAsset.</p>
 *
 * <p><b>描述：时钟</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-10 下午6:20:49
 *        
 * @since 1.0
 */
class ClockAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/clock';
	public $js = [ 
			'clock.js' 
	];
	public $css = [ 
			'clock.css' 
	];
	public $depends = [ 
			'yii\web\JqueryAsset',
	];
}
