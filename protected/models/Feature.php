<?php

class Feature extends FeatureBase
{
	/**
	 * @param string $className
	 * @return Feature
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}