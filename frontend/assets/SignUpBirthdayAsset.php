<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 *
 *
 * <p><b>标题：</b>frontend\assets$SignUpBirthdayAsset.</p>
 *
 * <p><b>描述：</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-11 上午11:42:10
 *        
 * @since 1.0
 */
class SignUpBirthdayAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/signup';
	public $js = [ 
			'signup.js' 
	];
	public $depends = [ 
			'frontend\assets\My97DatePickerAsset' 
	];
}