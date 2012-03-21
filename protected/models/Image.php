<?php

class Image extends ImageBase
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
	 * @return array
	 */
	public function defaultScope()
	{
		return CMap::mergeArray(
			parent::defaultScope(),
			array(
				'order' => 'image.position',
			)
		);
	}

}