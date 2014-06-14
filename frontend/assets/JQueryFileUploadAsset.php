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
			'js/jquery-ui.min.js',
			'js/load-image.min.js',
			'js/canvas-to-blob.min.js', 
			'js/jquery.blueimp-gallery.min.js',
			'js/jquery.iframe-transport.js',
			'js/jquery.fileupload.js',
			'js/jquery.fileupload-process.js',
			'js/jquery.fileupload-image.js',
			'js/jquery.fileupload-validate.js',
			'js/jquery.fileupload-ui.js',
			'js/jquery.fileupload-jquery-ui.js',
			
	];
	public $css = [ 
			'css/blueimp-gallery.min.css',
			'css/jquery-ui.css',
			'css/jquery.fileupload.css',
			'css/jquery.fileupload-ui.css', 
	];
	public $depends = [
			'yii\jui\ProgressBarAsset'
	];
}
