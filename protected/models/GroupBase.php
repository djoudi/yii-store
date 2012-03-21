<?php

/**
 * This is the model class for table "group".
 *
 * The followings are the available columns in table 'group':
 * @property string $id
 * @property string $name
 * @property double $discount
 */
abstract class GroupBase extends CActiveRecord
{

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'group';
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'users' => array(self::HAS_MANY, 'User', 'group_id'),
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
			'discount' => 'Discount',
		);
	}

}