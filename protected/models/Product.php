<?php

class Product extends ProductBase
{

	/**
	 * @param string $className
	 * @return Product
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
				'condition' => 'product.status = :status',
				'params' => array(':status' => Product::STATUS_ENABLED),
				'order' => 'product.position',
			)
		);
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('product/view', array(
			'id' => $this->id,
			'name' => $this->name,
		));
	}

	/**
	 * @param array $productsIds
	 * @param int $limit
	 * @return mixed
	 */
	public function findBrowsedProducts(array $productsIds, $limit = 20)
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('specifications', 'images');
		$criteria->limit = $limit;
		$criteria->addInCondition('product.id', $productsIds);

		return $this->findAll($criteria);
	}

	/**
	 * @param int $limit
	 * @return mixed
	 */
	public function findDiscountedProducts($limit = 6)
	{
		$discountedQuery = new CDbExpression('(SELECT 1 FROM specification specification WHERE specification.product_id=product.id AND specification.compare_price>0 LIMIT 1) = 1');

		return $this->findAll(array(
			'with' => array('specifications', 'images'),
			'condition' => $discountedQuery,
			'order' => 'product.create_time DESC',
			'limit' => $limit,
		));
	}

	/**
	 * @param int $limit
	 * @return mixed
	 */
	public function findFeaturedProducts($limit = 6)
	{
		return $this->findAll(array(
			'with' => array('specifications', 'images'),
			'condition' => 'product.featured=:featured',
			'params' => array(':featured' => 1),
			'limit' => $limit,
		));
	}

	/**
	 * @param int $limit
	 * @return mixed
	 */
	public function findCreatedProducts($limit = 6)
	{
		return $this->findAll(array(
			'with' => array('specifications', 'images'),
			'order' => 'product.create_time DESC',
			'limit' => $limit,
		));
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function findPrevProduct($id)
	{
		return $this->find(array(
			'condition' => 'product.id < :id',
			'params' => array(':id' => $id),
			'order' => 'product.create_time DESC, product.id DESC',
		));
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function findNextProduct($id)
	{
		return $this->find(array(
			'condition' => 'product.id > :id',
			'params' => array(':id' => $id),
			'order' => 'product.create_time, product.id',
		));
	}

	/**
	 * @param Comment $comment
	 * @return bool
	 */
	public function addComment(Comment $comment)
	{
		$comment->type = Comment::TYPE_PRODUCT;
		$comment->object_id = $this->id;
		return $comment->save();
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('url', $this->url, true);
		$criteria->compare('brand_id', $this->brand_id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('annotation', $this->annotation, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('position', $this->position, true);
		$criteria->compare('meta_title', $this->meta_title, true);
		$criteria->compare('meta_keywords', $this->meta_keywords, true);
		$criteria->compare('meta_description', $this->meta_description, true);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('update_time', $this->update_time, true);
		$criteria->compare('featured', $this->featured);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}