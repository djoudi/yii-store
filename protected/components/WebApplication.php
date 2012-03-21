<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Евгений
 * Date: 21.03.12
 * Time: 8:59
 * To change this template use File | Settings | File Templates.
 */
class WebApplication extends CWebApplication
{

	public function __construct($config = null)
	{
		parent::__construct($config);
		register_shutdown_function(array($this, 'shutdownHandler'));
	}

	public function shutdownHandler()
	{
		if (YII_ENABLE_ERROR_HANDLER && ($error = error_get_last())) {
			$this->handleError(
				$error['type'],
				$error['message'],
				$error['file'],
				$error['line']
			);
			$this->end();
		}
	}
}
