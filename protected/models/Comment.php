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
class Comment extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	const TYPE_BLOG = 'blog';
	const TYPE_PRODUCT = 'product';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip, name, text, type, create_time, update_time', 'required'),
			array('status', 'numerical', 'integerOnly' => true),
			array('ip', 'length', 'max' => 20),
			array('name', 'length', 'max' => 255),
			array('type', 'length', 'max' => 7),
			array('object_id, create_time, update_time', 'length', 'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ip, name, text, type, object_id, status, create_time, update_time', 'safe', 'on' => 'search'),
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
			'post' => array(self::BELONGS_TO, 'Blog', 'object_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
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
	 * @return bool
	 */
	public function isEnable()
	{
		return $this->count(array(
			'condition' => 'status=:status AND ip=:ip',
			'params' => array(
				':status' => self::STATUS_ENABLED,
				':ip' => $_SERVER['REMOTE_ADDR'],
			),
		));
	}

	/**
	 * Enables a comment.
	 */
	public function enable()
	{
		$this->status = self::STATUS_ENABLED;
		$this->update(array('status'));
	}

	/**
	 * @param Blog $post the post that this comment belongs to. If null, the method
	 * will query for the post.
	 * @return string the permalink URL for this comment
	 */
	public function getUrl(Blog $post = null)
	{
		if ($post === null)
			$post = $this->post;
		return $post->url . '#c' . $this->id;
	}

	/**
	 * @return string the hyperlink display for the current comment's author
	 */
	public function getAuthorLink()
	{
		if (!empty($this->url))
			return CHtml::link(CHtml::encode($this->author), $this->url);
		else
			return CHtml::encode($this->author);
	}

	/**
	 * @return integer the number of comments that are pending approval
	 */
	public function getPendingCommentCount()
	{
		return $this->count('status=' . self::STATUS_DISABLED);
	}

	/**
	 * @param integer the maximum number of comments that should be returned
	 * @return array the most recently added comments
	 */
	public function findRecentComments($limit = 10)
	{
		return $this->with('post')->findAll(array(
			'condition' => 't.status=' . self::STATUS_ENABLED,
			'order' => 't.create_time DESC',
			'limit' => $limit,
		));
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
				$this->create_time = time();
			return true;
		}
		else
			return false;
	}

	/**
	 * @return CDbCacheDependency
	 */
	public function getCacheDependency()
	{
		return new CDbCacheDependency('SELECT MAX(`update_time`) FROM ' . $this->tableName());
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
		$criteria->compare('ip', $this->ip, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('text', $this->text, true);
		$criteria->compare('type', $this->type, true);
		$criteria->compare('object_id', $this->object_id, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('update_time', $this->update_time, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}