<?php

/**
 * This is the model class for table "product_category".
 *
 * The followings are the available columns in table 'product_category':
 * @property string $product_id
 * @property string $category_id
 * @property string $position
 */
class ProductCategoryBase extends CActiveRecord
{

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'product_category';
	}

	/**
	 * @return array
	 */
	public function primaryKey()
	{
		return array(
			'product_id',
			'category_id',
		);
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'products' => array(self::HAS_MANY, 'Product', 'product_id'),
			'categories' => array(self::HAS_MANY, 'Category', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Product',
			'category_id' => 'Category',
			'position' => 'Position',
		);
	}

	/**
	 * @return array
	 */
	public function defaultScope()
	{
		return array(
			'alias' => $this->tableName(),
		);
	}

}