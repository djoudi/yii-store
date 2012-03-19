<?php

return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'defaultController' => 'site',
	'name' => 'My Yii Store',

	// язык поумолчанию
	'language' => 'ru',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
	),

	'modules' => array(

	),

	// application components
	'components' => array(
		'taobao' => array(
			'class' => 'application.extensions.taobao.TopClient',
			'appkey' => '12033604',
			'secretKey' => '21067fee0890d5f283d7dd12b2ea7f19',
			'format' => 'json',
		),
		'user' => array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl' => array('/user/login'),
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				// blog routes
				'blog/<url:.*?>' => 'blog/view',
				// product routes
				'product/<url:.*?>' => 'product/view',
				// default routes
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => 'webmaster@example.com',

		'postsPageSize' => 10,
		'recentPostsLimit' => 5,

		'browsedProductsLimit' => 20,
		'featuredProductsLimit' => 6,
		'newProductsLimit' => 6,
		'discountedProductsLimit' => 6,
	),
);