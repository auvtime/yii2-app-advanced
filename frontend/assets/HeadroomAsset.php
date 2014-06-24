<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * 
 * <p><b>标题：</b>frontend\assets$HeadroomAsset.</p>
 *
 * <p><b>描述：滚动鼠标的时候隐藏导航条</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-22 下午7:47:25
 *
 * @since 1.0
 */
class HeadroomAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/headroom';
	public $css = [
		'css/headroom.css'
	];
	public $js = [ 
			'js/headroom.js',
			'js/jQuery.headroom.min.js',
			'js/auvtimeHead.js', 
	];
	
}
