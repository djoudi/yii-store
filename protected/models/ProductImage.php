<?php

class ProductImage extends ProductImageBase
{

	/**
	 * @param string $className
	 * @return Image
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @param $width
	 * @param $height
	 * @return mixed
	 */
	public function getSrc($width, $height)
	{
		return Yii::app()->createUrl('image/resize', array(
			'width' => $width,
			'height' => $height,
			'file' => $this->file,
		));
	}

	/**
	 * @param $width
	 * @param $height
	 * @param $alt
	 * @return string
	 */
	public function getImage($width, $height, $alt)
	{
		$src = $this->getSrc($width, $height);
		return CHtml::image($src, CHtml::encode($alt));
	}

}