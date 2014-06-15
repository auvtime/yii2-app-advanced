<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * 
 * <p><b>标题：</b>frontend\assets$UserFaceAsset.</p>
 *
 * <p><b>描述：用户头像css和js</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-8 下午3:04:53
 *
 * @since 1.0
 */
class UserFaceAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/userface';
	public $js = [ 
			'jquery.cropzoom.js',
			'userface.js', 
	];
	public $css = [ 
			'userface.css', 
	];
	public $depends = [ 
			'frontend\assets\AppAsset',
			'frontend\assets\JQueryFileUploadAsset',
	];
}
