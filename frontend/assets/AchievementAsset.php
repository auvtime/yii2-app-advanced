<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * 
 * <p><b>标题：</b>frontend\assetsAchievementAsset.</p>
 *
 * <p><b>描述：我的成就js和css</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 下午1:19:10
 *
 * @since 1.0
 */
class AchievementAsset extends AssetBundle {
	public $language;
	public $sourcePath = '@app/auvtime/achievement';
	public $js = [ ];
	public $css = [ 
			'achievement.css' 
	];
	public $depends = [ 
			'frontend\assets\AppAsset',
			'frontend\assets\My97DatePickerAsset' 
	];
	public function registerAssetFiles($view) {
		$language = $this->language ? $this->language : Yii::$app->language;
		$this->js [] = 'achievement-' . $language . '.js';
		parent::registerAssetFiles ( $view );
	}
}