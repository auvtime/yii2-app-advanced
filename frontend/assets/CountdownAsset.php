<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 *
 * <p><b>标题：</b>frontend\assets$CountdownAsset.</p>
 *
 * <p><b>描述：倒计时css和js</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-10-18 下午7:58:00
 *        
 * @since 1.0
 */
class CountdownAsset extends AssetBundle
{

    public $sourcePath = '@app/auvtime/countdown';

    public $js = [
        'jquery.countdown.js',
        'countdown.js'
    ];

    public $css = [
        'countdown.css'
    ];

    public $depends = [
        'frontend\assets\AppAsset',
        'frontend\assets\JQueryMsgboxAsset'
    ];
}
