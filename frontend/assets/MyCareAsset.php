<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * 
 * <p><b>标题：</b>frontend\assets$MyCareAsset.</p>
 *
 * <p><b>描述：关心的人</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-3 下午5:26:29
 *
 * @since 1.0
 */
class MyCareAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/mycare';
	public $js = [
			'layer/layer/layer.min.js', 
			'mycare.js', 
	];
	public $css = [ 
			'mycare.css' 
	];
	public $depends = [ 
			'frontend\assets\AppAsset',
			'yii\jui\DraggableAsset', 
	];
}
