<?php

/**
 * This is the model class for table "purchase".
 *
 * The followings are the available columns in table 'purchase':
 * @property string $id
 * @property string $order_id
 * @property string $product_id
 * @property string $product_name
 * @property string $variant_id
 * @property string $variant_name
 * @property double $price
 * @property string $amount
 * @property string $sku
 */
abstract class PurchaseBase extends CActiveRecord
{


	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'purchase';
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'variant' => array(self::BELONGS_TO, 'ProductVariant', 'variant_id'),
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