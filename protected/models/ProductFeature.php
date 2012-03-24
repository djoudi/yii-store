<?php

class ProductFeature extends ProductFeatureBase
{

	/**
	 * @param string $className
	 * @return ProductFeature
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}