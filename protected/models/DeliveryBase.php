<?php

/**
 * This is the model class for table "delivery".
 *
 * The followings are the available columns in table 'delivery':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property integer $status
 * @property string $position
 * @property integer $separate
 */
abstract class DeliveryBase extends CActiveRecord
{


	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'delivery';
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
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
			'description' => 'Description',
			'price' => 'Price',
			'status' => 'Status',
			'position' => 'Position',
			'separate' => 'Separate',
		);
	}

}