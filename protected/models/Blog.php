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
class Blog extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Blog the static model class
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
		return 'blog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, url, meta_title, meta_keywords, meta_description, annotation, text, create_time, update_time', 'required'),
			array('status', 'in', 'range' => array(self::STATUS_DISABLED, self::STATUS_ENABLED)),
			array('name, meta_title, meta_keywords, meta_description', 'length', 'max' => 500),
			array('url', 'length', 'max' => 255),
			array('create_time, update_time', 'length', 'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, meta_title, meta_keywords, meta_description, annotation, text, status, create_time, update_time', 'safe', 'on' => 'search'),
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
			'comments' => array(self::HAS_MANY, 'Comment', 'object_id',
				'condition' => 'comments.status=' . Comment::STATUS_ENABLED,
				'order' => 'comments.create_time DESC',
			),
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
	 * Default scope
	 *
	 * @return array
	 */
	public function defaultScope()
	{
		return array(
			'alias' => $this->tableName(),
			'order' => 'blog.create_time DESC',
		);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getLink()
	{
		return Yii::app()->createUrl('<controller:\w+>/view', array(
			'controller' => 'blog',
			'url' => $this->url,
		));
	}

	/**
	 * Adds a new comment to this post.
	 * This method will set status and post_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment(Comment $comment)
	{
		$comment->type = Comment::TYPE_BLOG;
		$comment->object_id = $this->id;
		return $comment->save();
	}

	/**
	 * @param integer the maximum number of comments that should be returned
	 * @return array the most recently added comments
	 */
	public function findRecentPosts($limit = 10)
	{
		return $this->findAll(array(
			'condition' => 'blog.status=' . self::STATUS_ENABLED,
			'limit' => $limit,
		));
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->create_time = $this->update_time = time();
			}
			else
				$this->update_time = time();

			return true;
		}
		else
			return false;
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	protected function afterDelete()
	{
		parent::afterDelete();
		Comment::model()->deleteAll(array(
			'condition' => 'type=:type AND object_id=:object_id',
			'params' => array(
				':type' => Comment::TYPE_BLOG,
				':object_id' => $this->id,
			),
		));
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
		$criteria->compare('name', $this->name, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('meta_title', $this->meta_title, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('meta_description', $this->meta_description, true);
		$criteria->compare('annotation', $this->annotation, true);
		$criteria->compare('text', $this->text, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('update_time', $this->update_time, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
				'defaultOrder' => 'status, update_time DESC',
			),
		));
	}

}