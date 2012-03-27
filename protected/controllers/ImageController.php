<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Евгений
 * Date: 26.03.12
 * Time: 14:12
 * To change this template use File | Settings | File Templates.
 */
class ImageController extends CController
{

	public function actionResize($width, $height, $file)
	{
		$file = realpath(implode(DIRECTORY_SEPARATOR, array(
			Yii::getPathOfAlias('webroot.assets.products'),
			$file,
		)));

		$image = Yii::app()->image->load($file);
		$image->resize($width, $height);
		echo $image->render();
	}

}