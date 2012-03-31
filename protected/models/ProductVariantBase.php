<?php

/**
 * This is the model class for table "ProductVariant".
 *
 * The followings are the available columns in table 'specification':
 * @property string $id
 * @property string $product_id
 * @property string $sku
 * @property string $name
 * @property double $price
 * @property double $compare_price
 * @property integer $stock
 * @property string $position
 */
abstract class ProductVariantBase extends CActiveRecord
{


	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'product_variant';
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'product' => array(self::HAS_ONE, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'sku' => 'Sku',
			'name' => 'Name',
			'price' => 'Price',
			'compare_price' => 'Compare Price',
			'stock' => 'Stock',
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