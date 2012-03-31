<?php

/**
 * This is the model class for table "blog".
 *
 * The followings are the available columns in table 'blog':
 * @property string $id
 * @property string $name
 * @property string $url
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $annotation
 * @property string $text
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
abstract class BlogBase extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'blog';
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'comments' => array(self::HAS_MANY, 'Comment', 'object_id',
				'condition' => 'comment.type = :type',
				'params' => array(':type' => Comment::TYPE_BLOG),
				'order' => 'comment.create_time DESC',
			),
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
			'url' => 'Url',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'annotation' => 'Annotation',
			'text' => 'Text',
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