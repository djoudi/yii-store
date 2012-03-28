<?php

/**
 * This is the model class for table "product_related".
 *
 * The followings are the available columns in table 'product_related':
 * @property string $product_id
 * @property string $related_id
 * @property string $position
 */
abstract class ProductRelatedBase extends CActiveRecord
{

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'product_related';
	}

	/**
	 * @return array
	 */
	public function primaryKey()
	{
		return array(
			'product_id',
			'related_id',
		);
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'products' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'relateds' => array(self::BELONGS_TO, 'Product', 'related_id'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Product',
			'related_id' => 'Related',
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