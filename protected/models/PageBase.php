<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property string $id
 * @property string $name
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $body
 * @property string $menu_id
 * @property string $position
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 * @property string $header
 * @property string $controller
 * @property string $action
 */
abstract class PageBase extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'page';
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
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'body' => 'Body',
			'menu_id' => 'Menu',
			'position' => 'Position',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'header' => 'Header',
			'controller' => 'Controller',
			'action' => 'Action',
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