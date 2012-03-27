<?php

class Feature extends FeatureBase
{

	public $value;

	/**
	 * @param string $className
	 * @return Feature
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}