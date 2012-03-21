<?php

class Blog extends BlogBase
{

	/**
	 * @param string $className
	 * @return Blog
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array
	 */
	public function defaultScope()
	{
		return CMap::mergeArray(
			parent::defaultScope(),
			array(
				'condition' => 'blog.status = :status',
				'params' => array(':status' => self::STATUS_ENABLED)
			)
		);
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('blog/view', array(
			'id' => $this->id,
			'name' => $this->name,
		));
	}

	/**
	 * @param Comment $comment
	 * @return bool
	 */
	public function addComment(Comment $comment)
	{
		$comment->type = Comment::TYPE_BLOG;
		$comment->object_id = $this->id;
		return $comment->save();
	}

	/**
	 * @param int $limit
	 * @return array
	 */
	public function findRecentPosts($limit = 10)
	{
		return $this->findAll(array(
			'order' => 'blog.create_time',
			'limit' => $limit,
		));
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function findPrevPost($id)
	{
		return $this->find(array(
			'condition' => 'blog.id < :id',
			'params' => array(':id' => $id),
			'order' => 'blog.create_time DESC, blog.id DESC',
		));
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function findNextPost($id)
	{
		return $this->find(array(
			'condition' => 'blog.id > :id',
			'params' => array(':id' => $id),
			'order' => 'blog.create_time, blog.id',
		));
	}

}