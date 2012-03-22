<?php

class Category extends CategoryBase
{

	/**
	 * @param string $className
	 * @return Category
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
				'condition' => 'category.status = :status',
				'params' => array(':status' => self::STATUS_ENABLED),
			)
		);
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('category/view', array(
			'id' => $this->id,
			'name' => $this->name,
		));
	}

}