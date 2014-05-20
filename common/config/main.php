<?php
return [ 
		'name' => 'AUVTime',
		'charset' => 'utf-8',
		'timezone' => 'Asia/Shanghai',
		'vendorPath' => dirname ( dirname ( __DIR__ ) ) . '/vendor',
		'extensions' => require (__DIR__ . '/../../vendor/yiisoft/extensions.php'),
		'language' => 'zh_CN',
		'components' => [ 
				'db' => [ 
						'class' => 'yii\db\Connection',
						'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
						'username' => 'root',
						'password' => 'passwd',
						'charset' => 'utf8' 
				],
				'mail' => [ 
						'class' => 'yii\swiftmailer\Mailer',
						'viewPath' => '@common/mail',
						// 'useFileTransport' => true,
						'transport' => [ 
								'class' => 'Swift_SmtpTransport',
								'host' => 'smtp.auvtime.com',
								'username' => 'admin@auvtime.com',
								'password' => 'AuVTime88admin',
								'port' => '25' 
						] 
				],
				'cache' => [ 
						'class' => 'yii\caching\FileCache' 
				],
				'urlManager' => [ 
						'enablePrettyUrl' => true,
						'showScriptName' => false,
						'rules' => [ 
								'home' => 'site/index',
								'home/<alias>' => 'site/<alias>' 
						] 
				],
				'i18n' => [ 
						'translations' => [ 
								'yii' => [ 
										'class' => 'yii\i18n\PhpMessageSource',
										'sourceLanguage' => 'en',
										'basePath' => '@app/messages' 
								],
								'auvtime' => [ 
										'class' => 'yii\i18n\PhpMessageSource',
										'sourceLanguage' => 'en',
										'basePath' => '@app/messages',
										'fileMap' => [ 
												'auvtime' => 'auvtime.php' 
										] 
								],
								'contact' => [ 
										'class' => 'yii\i18n\PhpMessageSource',
										'sourceLanguage' => 'en',
										'basePath' => '@app/messages',
										'fileMap' => [ 
												'contact' => 'contact.php' 
										] 
								],
								'auvtime-lifetime' => [ 
										'class' => 'yii\i18n\PhpMessageSource',
										'sourceLanguage' => 'en',
										'basePath' => '@app/messages',
										'fileMap' => [ 
												'auvtime-lifetime' => 'auvtime-lifetime.php' 
										] 
								],
								'auvtime-leavetime' => [ 
										'class' => 'yii\i18n\PhpMessageSource',
										'sourceLanguage' => 'en',
										'basePath' => '@app/messages',
										'fileMap' => [ 
												'auvtime-leavetime' => 'auvtime-leavetime.php' 
										] 
								] 
						] 
				] 
		] 
];
