<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property string $id
 * @property string $ip
 * @property string $name
 * @property string $text
 * @property string $type
 * @property string $object_id
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
abstract class CommentBase extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	const TYPE_BLOG = 'blog';
	const TYPE_PRODUCT = 'product';

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'comment';
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'post' => array(self::BELONGS_TO, 'Blog', 'object_id'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ip' => 'Ip',
			'name' => 'Name',
			'text' => 'Text',
			'type' => 'Type',
			'object_id' => 'Object',
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