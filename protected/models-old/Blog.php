<?php

/**
 * This is the model class for table "{{blog}}".
 *
 * The followings are the available columns in table '{{blog}}':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $annotation
 * @property string $text
 * @property integer $visible
 * @property string $date
 */
class Blog extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class
	 *
	 * @param string $className
	 * @return Blog
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * the associated database table name
	 *
	 * @return string
	 */
	public function tableName()
	{
		return '{{blog}}';
	}

	/**
	 * validation rules for model attributes
	 *
	 * @return array
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, url, meta_title, meta_keywords, meta_description, annotation, text', 'required'),
			array('visible', 'in', 'range' => array(0, 1)),
			array('name, meta_title, meta_keywords, meta_description', 'length', 'max' => 500),
			array('url', 'length', 'max' => 255),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, meta_title, meta_keywords, meta_description, annotation, text, visible, date', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * relational rules
	 *
	 * @return array
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments' => array(self::HAS_MANY, 'Comments', 'object_id',
				'condition' => 'comments.approved=1',
				'order' => 'comments.date DESC',
			),
			'commentCount' => array(self::STAT, 'Comments', 'object_id',
				'condition' => "type='blog' AND approved=1"),
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
			'name' => 'Name',
			'url' => 'Url',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'annotation' => 'Annotation',
			'text' => 'Text',
			'visible' => 'Visible',
			'date' => 'Date',
		);
	}

	/**
	 * Ссылка на пост
	 *
	 * @return mixed
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('blog/view', array(
			'url' => $this->url,
		));
	}

	/**
	 * Недавние посты
	 *
	 * @param int $limit
	 * @return mixed
	 */
	public function findRecent($limit = 5)
	{
		return $this->findAll(array(
			'condition' => 't.visible = 1',
			'order' => 't.date DESC',
			'limit' => $limit,
		));
	}

	/**
	 * Предыдущий пост
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findPrev($id)
	{
		return $this->find(array(
			'condition' => 't.id < :id AND t.visible = 1',
			'params' => array(':id' => $id),
			'order' => 't.id DESC',
		));
	}

	/**
	 * Следующий пост
	 *
	 * @param $id
	 * @return mixed
	 */
	public function findNext($id)
	{
		return $this->find(array(
			'condition' => 't.id > :id AND t.visible = 1',
			'params' => array(':id' => $id),
			'order' => 't.id',
		));
	}

	/**
	 * Добавляем комметарий к посту
	 *
	 * @param Comments $comment
	 * @return mixed
	 */
	public function addComment(Comments $comment)
	{
		$comment->type = 'blog';
		$comment->object_id = $this->id;

		return $comment->save();
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
		$criteria->compare('name', $this->name, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('meta_title', $this->meta_title, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('meta_description', $this->meta_description, true);
		$criteria->compare('annotation', $this->annotation, true);
		$criteria->compare('text', $this->text, true);
		$criteria->compare('visible', $this->visible);
		$criteria->compare('date', $this->date, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}