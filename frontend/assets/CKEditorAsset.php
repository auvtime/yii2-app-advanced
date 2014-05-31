<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * 
 * <p><b>标题：</b>frontend\assets$CKEditor.</p>
 *
 * <p><b>描述：ckeditor编辑器</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-28 下午1:11:19
 *
 * @since 1.0
 */
class CKEditorAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/ckeditor';
	public $js = [ 
			'ckeditor.js',
			'adapters/jquery.js'
	];
	public $depends = [ 
			'frontend\assets\AppAsset'
	];
}
