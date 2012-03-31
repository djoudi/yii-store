<?php

return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',

	// default controller
	'defaultController' => 'site',

	// project name
	'name' => 'My Yii Store',

	// current theme
	'theme' => 'classic',

	// язык поумолчанию
	'language' => 'ru',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.helpers.*',
		'application.components.*',
		'application.components.blog.*',
		'application.components.toabao.*',
		'application.components.product.*',
	),

	// modules
	'modules' => array(

	),

	// application components
	'components' => array(
		'cart' => array(
			'class' => 'application.extensions.cart.Cart',
		),
		'money' => array(
			'class' => 'application.extensions.money.Money',
		),
		'taobao' => array(
			'class' => 'application.extensions.taobao.TopClient',
			'appkey' => '12033604',
			'secretKey' => '21067fee0890d5f283d7dd12b2ea7f19',
			'format' => 'json',
		),
		'image' => array(
			'class' => 'application.extensions.image.CImageComponent',
			'driver' => 'GD',
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
				'<controller:\w+>' => '<controller>/index',
				/*'<controller:\w+>/<action:\w+>' => '<controller>/<action>',*/
				'<controller:\w+>/<id:\d+>-<name:.*?>' => '<controller>/view',
				/*'<controller:\w+>/<id:\d+>' => '<controller>/view',*/
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
	'params' => require('params.php'),
);