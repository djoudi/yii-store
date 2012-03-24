<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property string $id
 * @property string $product_id
 * @property string $file
 * @property string $position
 */
abstract class ImageBase extends CActiveRecord
{

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('product_id, file, position', 'required'),
			array('file', 'length', 'max' => 255),
			array('product_id, position', 'length', 'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,product_id, file, position', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'product' => array(self::HAS_ONE, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'file' => 'File',
			'position' => 'Position',
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