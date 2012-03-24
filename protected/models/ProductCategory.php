<?php

/**
 * This is the model class for table "product_category".
 *
 * The followings are the available columns in table 'product_category':
 * @property string $product_id
 * @property string $category_id
 * @property string $position
 */
class ProductCategory extends ProductCategoryBase
{
	/**
	 * @param string $className
	 * @return ProductCategory
	 */
	public static function model($className=__CLASS__)
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
				'order' => 'product_category.position',
			)
		);
	}

}