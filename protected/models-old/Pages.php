<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property integer $id
 * @property string $url
 * @property string $name
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $body
 * @property integer $menu_id
 * @property integer $position
 * @property integer $visible
 * @property string $header
 */
class Pages extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class
	 *
	 * @param string $className
	 * @return Pages
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * The associated database table name
	 *
	 * @return string
	 */
	public function tableName()
	{
		return '{{pages}}';
	}

	/**
	 * Validation rules for model attributes
	 *
	 * @return array
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('meta_title, meta_description, meta_keywords, body, header', 'required'),
			array('menu_id, position, visible', 'numerical', 'integerOnly' => true),
			array('url, name', 'length', 'max' => 255),
			array('meta_title, meta_description, meta_keywords', 'length', 'max' => 500),
			array('header', 'length', 'max' => 1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, url, name, meta_title, meta_description, meta_keywords, body, menu_id, position, visible, header', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * Scopes
	 *
	 * @return array
	 */
	public function scopes()
	{

	}

	/**
	 * Relational rules
	 *
	 * @return array
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * Customized attribute labels (name=>label)
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'name' => 'Name',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'body' => 'Body',
			'menu_id' => 'Menu',
			'position' => 'Position',
			'visible' => 'Visible',
			'header' => 'Header',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions
	 *
	 * @return CActiveDataProvider
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('meta_title', $this->meta_title, true);
		$criteria->compare('meta_description', $this->meta_description, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('menu_id', $this->menu_id);
		$criteria->compare('position', $this->position);
		$criteria->compare('visible', $this->visible);
		$criteria->compare('header', $this->header, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}