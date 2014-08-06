<?php
return [ 
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
						//'useFileTransport' => true,
						'transport' => [ 
								'class' => 'Swift_SmtpTransport',
								'host' => 'smtp.auvtime.com',
								'username' => 'admin@auvtime.com',
								'password' => 'AuVTime88admin',
								'port' => '25', 
						] 
				] 
		] 
];
