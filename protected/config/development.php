<?php

return CMap::mergeArray(
	require(dirname(__FILE__) . '/main.php'),
	array(
		'modules' => array(
			'gii' => array(
				'class' => 'system.gii.GiiModule',
				'password' => 'gii',
				'ipFilters' => array('127.0.0.1', '::1'),
			),
		),
		'components' => array(
			'cache' => array(
				'class' => 'system.caching.CXCache',
			),
			'db' => array(
				'connectionString' => 'mysql:host=localhost;dbname=yii-store',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'root',
				'charset' => 'utf8',
				'schemaCachingDuration' => 1000,
				'enableProfiling' => true,
				'enableParamLogging' => true,
			),
			'log' => array(
				'routes' => array(
					array(
						'class' => 'CProfileLogRoute',
						'levels' => 'profile',
						'enabled' => true,
					),
				),
			),
		),
	)
);
