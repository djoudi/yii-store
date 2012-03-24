<?php

class Comment extends CommentBase
{

	public $verifyCode;

	/**
	 * @param string $className
	 * @return Comment
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return array(
			// create
			array('name, text', 'required', 'on' => 'create'),
			array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'create'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(
			parent::attributeLabels(),
			array(
				'verifyCode' => 'Verification Code',
			)
		);
	}

	/**
	 * @return array
	 */
	public function defaultScope()
	{
		return CMap::mergeArray(
			parent::defaultScope(),
			array(
				'condition' => 'comment.status = :status OR comment.ip = :ip',
				'params' => array(
					':status' => self::STATUS_ENABLED,
					':ip' => Yii::app()->request->userHostAddress,
				),
			)
		);
	}

	/**
	 * @return bool
	 */
	public function isEnable()
	{
		return $this->exists(array(
			'condition' => 'status = :status AND ip = :ip',
			'params' => array(
				':status' => self::STATUS_ENABLED,
				':ip' => Yii::app()->request->userHostAddress,
			),
		));
	}

	/**
	 * @param Blog $post
	 * @return string
	 */
	public function getUrl(Blog $post = null)
	{
		if ($post === null)
			$post = $this->post;
		return $post->url . '#c' . $this->id;
	}

	/**
	 * @return string
	 */
	public function getNameLink()
	{
		if (!empty($this->url))
			return CHtml::link(CHtml::encode($this->name), $this->url);
		else
			return CHtml::encode($this->name);
	}

	/**
	 * @return bool
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->status = $this->isEnable();
				$this->create_time = $this->update_time = time();
				$this->ip = Yii::app()->request->userHostAddress;
			}
			else
				$this->update_time = time();
			return true;
		}
		else
			return false;
	}

}