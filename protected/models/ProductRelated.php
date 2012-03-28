<?php

class ProductRelated extends ProductRelatedBase
{

	/**
	 * @param string $className
	 * @return ProductRelated
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}