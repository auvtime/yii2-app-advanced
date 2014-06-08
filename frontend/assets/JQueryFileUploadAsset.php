<?php

namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * 
 * <p><b>标题：</b>frontend\assets$JQueryFileUploadAsset.</p>
 *
 * <p><b>描述：jQuery File Upload js and css files</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-8 下午7:34:51
 *
 * @since 1.0
 */
class JQueryFileUploadAsset extends AssetBundle {
	public $sourcePath = '@app/auvtime/jqueryfileupload';
	public $js = [ 
			'jquery.fileupload.js',
			'jquery.fileupload-process.js',
			'jquery.fileupload-image.js',
			'jquery.fileupload-jquery-ui.js',
			
			'jquery.fileupload-ui.js',
			'jquery.fileupload-validate.js',
			'jquery.iframe-transport.js' 
	];
	public $css = [ 
			'jquery.fileupload-ui.css' 
	];
	public $depends = [
			'yii\jui\ProgressBarAsset'
	];
}
