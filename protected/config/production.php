<?php

return CMap::mergeArray(
	require(dirname(__FILE__) . '/main.php'),
	array(
		'components' => array(
			'request' => array(
				'enableCsrfValidation' => true,
				'enableCookieValidation' => true,
			),
			'cache' => array(
				'class' => 'CDbCache',
			),
			'db' => array(
				'connectionString' => 'mysql:host=localhost;dbname=simpla',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'root',
				'charset' => 'utf8',
				'schemaCachingDuration' => 3600,
			),
			'session' => array(
				'class' => 'CDbHttpSession',
				'connectionID' => 'db',
				'autoCreateSessionTable' => false, // TODO: delete after first execution CREATE INDEX yiisession_expire_idx ON "yiisession" (expire)
			),
			'log' => array(
				'routes' => array(
					array(
						'class' => 'CEmailLogRoute',
						'categories' => 'error',
						'emails' => array('inasyrov@yandex.ru'),
						'sentFrom' => 'error@yiiframework.ru',
						'subject' => 'Error at YiiFramework.ru'
					),
				),
			),
		),
	)
);
