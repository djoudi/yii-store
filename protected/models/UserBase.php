<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $email
 * @property string $salt
 * @property string $password
 * @property string $name
 * @property string $group_id
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
abstract class UserBase extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'salt' => 'Salt',
			'password' => 'Пароль',
			'name' => 'Имя',
			'group_id' => 'Group',
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