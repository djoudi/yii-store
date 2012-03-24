<?php

/**
 * This is the model class for table "feature".
 *
 * The followings are the available columns in table 'feature':
 * @property integer $id
 * @property string $name
 * @property string $position
 * @property integer $in_filter
 */
abstract class FeatureBase extends CActiveRecord
{

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'feature';
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'options' => array(self::MANY_MANY, 'Product',
				'product_option(product_id,feature_id)'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'position' => 'Position',
			'in_filter' => 'In Filter',
		);
	}

}