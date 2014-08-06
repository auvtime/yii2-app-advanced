<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 *
 *
 * <p><b>标题：</b>frontend\assets$ClockAsset.</p>
 *
 * <p><b>描述：日期控件</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-11 上午11:33:04
 *        
 * @since 1.0
 */
class My97DatePickerAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/My97DatePicker';
	public $js = [ 
			'WdatePicker.js' 
	];
	public $css = [ 
			'skin/WdatePicker.css' 
	];
	public $depends = [ 
			'yii\web\JqueryAsset' 
	];
}