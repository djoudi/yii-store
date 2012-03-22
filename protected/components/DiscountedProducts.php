<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 20:22
 * To change this template use File | Settings | File Templates.
 */
class DiscountedProducts extends CWidget
{

	public $limit = 6;

	public function getProducts()
	{
		$discountedQuery = new CDbExpression('(SELECT 1 FROM specification specification WHERE specification.product_id=product.id AND specification.compare_price>0 LIMIT 1) = 1');

		return Product::model()->findAll(array(
			'with' => array('specifications', 'images'),
			'condition' => $discountedQuery,
			'order' => 'product.create_time DESC',
			'limit' => $this->limit,
		));
	}

	public function run()
	{
		$this->render('discountedProducts');
	}

}
