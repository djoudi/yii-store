<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property string $id
 * @property string $url
 * @property string $brand_id
 * @property string $name
 * @property string $annotation
 * @property string $body
 * @property integer $status
 * @property string $position
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $create_time
 * @property string $update_time
 * @property integer $featured
 */
abstract class ProductBase extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'product';
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'brand' => array(self::BELONGS_TO, 'Brand', 'product_id'),
			'variants' => array(self::HAS_MANY, 'Variant', 'product_id'),
			'images' => array(self::HAS_MANY, 'Image', 'product_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'object_id',
				'condition' => 'comments.status=' . Comment::STATUS_ENABLED,
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
			'url' => 'Url',
			'brand_id' => 'Brand',
			'name' => 'Name',
			'annotation' => 'Annotation',
			'body' => 'Body',
			'status' => 'Status',
			'position' => 'Position',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'featured' => 'Featured',
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