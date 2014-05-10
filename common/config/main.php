<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'language' => 'zh_cn',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
	            'home' => 'website/index',
	            '<alias:about>' => 'website/page',
	            'page/<alias>' => 'website/page',
			]
        ],
    ],
];
