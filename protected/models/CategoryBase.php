<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $description
 * @property string $url
 * @property string $image
 * @property string $position
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
abstract class CategoryBase extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'category';
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
			'parent_id' => 'Parent',
			'name' => 'Name',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'description' => 'Description',
			'url' => 'Url',
			'image' => 'Image',
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