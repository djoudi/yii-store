<?php

$webDir = dirname(__FILE__);

// Если хост равен localhost, то включаем режим отладки и подключаем отладочную
// конфигурацию
if ($_SERVER['HTTP_HOST'] == 'yii-store')
{
	// change the following paths if necessary
	$yii = $webDir . '/framework/yii.php';
	$config = $webDir . '/protected/config/development.php';
	// remove the following lines when in production mode
	define('YII_DEBUG', true);
	// specify how many levels of call stack should be shown in each log message
	define('YII_TRACE_LEVEL', 3);
}
// Иначе выключаем режим отладки и подключаем рабочую конфигурацию
else
{
	// change the following paths if necessary
	$yii = $webDir . '/framework/yiilite.php';
	$config = $webDir . '/protected/config/production.php';
	// отключаем отладку
	define('YII_DEBUG', false);
}

require_once($yii);
Yii::createWebApplication($config)->run();
