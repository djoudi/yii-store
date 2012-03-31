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
	public function findBrowsedProducts(array $productsIds, $limit)
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('variants', 'images');
		$criteria->limit = $limit;
		$criteria->addInCondition('product.id', $productsIds);

		return $this->findAll($criteria);
	}

	/**
	 * @param int $limit
	 * @return mixed
	 */
	public function findDiscountedProducts($limit)
	{
		$discountedQuery = new CDbExpression('(SELECT 1 FROM product_variant WHERE product_variant.product_id=product.id AND product_variant.compare_price > 0 LIMIT 1) = 1');

		return $this->findAll(array(
			'with' => array('variants', 'images'),
			'condition' => $discountedQuery,
			'order' => 'product.create_time DESC',
			'limit' => $limit,
		));
	}

	/**
	 * @param int $limit
	 * @return mixed
	 */
	public function findFeaturedProducts($limit)
	{
		return $this->findAll(array(
			'with' => array('variants', 'images'),
			'condition' => 'product.featured=:featured',
			'params' => array(':featured' => 1),
			'limit' => $limit,
		));
	}

	/**
	 * @param int $limit
	 * @return mixed
	 */
	public function findCreatedProducts($limit)
	{
		return $this->findAll(array(
			'with' => array('variants', 'images'),
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

}