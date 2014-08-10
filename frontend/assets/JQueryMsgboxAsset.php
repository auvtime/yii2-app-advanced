<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * 
 * <p><b>标题：</b>frontend\assetsJQueryMsgboxAsset.</p>
 *
 * <p><b>描述：jQuery msgbox</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-9 下午8:25:37
 *
 * @since 1.0
 */
class JQueryMsgboxAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/jmsgbox';
	public $js = [ 
			'jquery.msgbox.i18n.js',
			'jquery.msgbox.js', 
	];
	public $css = [ 
			'themes/bootstrap/css/jquery.msgbox.css' 
	];
	public $depends = [ 
			'yii\web\JqueryAsset'
	];
}
