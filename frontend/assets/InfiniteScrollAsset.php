<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * 
 * <p><b>标题：</b>frontend\assets$InfiniteScrollAsset.</p>
 *
 * <p><b>描述：滚动条滚动到页面底部的时候自动加载内容js</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-27 下午5:23:35
 *
 * @since 1.0
 */
class InfiniteScrollAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/infinitescroll';
	public $js = [ 
			'jquery.infinitescroll.min.js',
	];
	public $depends = [ 
			'yii\web\JqueryAsset'
	];
}
