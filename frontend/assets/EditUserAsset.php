<?php
namespace frontend\assets;

use yii\web\AssetBundle;
use yii;

/**
 * 
 * <p><b>标题：</b>EditUserAsset.</p>
 *
 * <p><b>描述：编辑用户js</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-9-21 下午12:33:19
 *
 * @since 1.0
 */
class EditUserAsset extends AssetBundle {
    public $language;
    public $sourcePath = '@app/auvtime/edituser';
    public $js = [];
    public $css = [];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
    public function registerAssetFiles($view) {
        $language = $this->language ? $this->language : Yii::$app->language;
        $this->js [] = 'edituser-' . $language . '.js';
        parent::registerAssetFiles ( $view );
    }
}