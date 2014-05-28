<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * 
 * <p><b>标题：</b>frontend\assets$ContactAsset.</p>
 *
 * <p><b>描述：联系我们页面js和css</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-28 下午1:17:51
 *
 * @since 1.0
 */
class ContactAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/contact';
	public $js = [ 
			'contact.js',
	];
	public $css = [ 
			'contact.css' 
	];
	public $depends = [ 
			'frontend\assets\CKEditorAsset'
	];
}
