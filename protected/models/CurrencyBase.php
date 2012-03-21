<?php

/**
 * This is the model class for table "currency".
 *
 * The followings are the available columns in table 'currency':
 * @property string $id
 * @property string $name
 * @property string $sign
 * @property string $code
 * @property double $rate_from
 * @property double $rate_to
 * @property integer $cents
 * @property string $position
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
abstract class CurrencyBase extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'currency';
	}

	/**
	 * @return array
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
			'sign' => 'Sign',
			'code' => 'Code',
			'rate_from' => 'Rate From',
			'rate_to' => 'Rate To',
			'cents' => 'Cents',
			'position' => 'Position',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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