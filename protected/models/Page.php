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
class Page extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, meta_title, meta_description, meta_keywords, body, create_time, update_time, header, controller, action', 'required'),
			array('status', 'numerical', 'integerOnly' => true),
			array('name, controller, action', 'length', 'max' => 255),
			array('meta_title, meta_description, meta_keywords', 'length', 'max' => 500),
			array('menu_id, position', 'length', 'max' => 11),
			array('create_time, update_time', 'length', 'max' => 10),
			array('header', 'length', 'max' => 1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, meta_title, meta_description, meta_keywords, body, menu_id, position, status, create_time, update_time, header, controller, action', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
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
			'order' => 'page.position',
		);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('<controller>/<action>', array(
			'controller' => $this->controller,
			'action' => $this->action,
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('meta_title', $this->meta_title, true);
		$criteria->compare('meta_description', $this->meta_description, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('menu_id', $this->menu_id, true);
		$criteria->compare('position', $this->position, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('update_time', $this->update_time, true);
		$criteria->compare('header', $this->header, true);
		$criteria->compare('controller', $this->controller, true);
		$criteria->compare('action', $this->action, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}