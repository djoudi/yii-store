<?php

/**
 * This is the model class for table "product_feature".
 *
 * The followings are the available columns in table 'product_feature':
 * @property string $product_id
 * @property string $feature_id
 * @property string $value
 */
abstract class ProductFeatureBase extends CActiveRecord
{

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'product_feature';
	}

	/**
	 * @return array
	 */
	public function primaryKey()
	{
		return array(
			'product_id',
			'feature_id',
		);
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'products' => array(self::HAS_MANY, 'Product', 'product_id'),
			'features' => array(self::HAS_MANY, 'Feature', 'feature_id'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Product',
			'feature_id' => 'Feature',
			'value' => 'Value',
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