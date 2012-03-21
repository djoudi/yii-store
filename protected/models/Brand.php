<?php

class Brand extends BrandBase
{

	/**
	 * @param string $className
	 * @return Brand
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
				'condition' => 'brand.status = :status',
				'params' => array(':status' => self::STATUS_ENABLED),
			)
		);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('brand/view', array(
			'id' => $this->id,
			'name' => $this->name,
		));
	}

}