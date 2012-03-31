<?php

class ProductVariant extends ProductVariantBase
{

	/**
	 * @param string $className
	 * @return ProductVariant
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
				'select' => array('*', 'IFNULL(product_variant.stock, 50) AS stock'),
			)
		);
	}

}