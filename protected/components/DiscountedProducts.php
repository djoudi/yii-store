<?php

Yii::import('zii.widgets.CPortlet');

/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 20:22
 * To change this template use File | Settings | File Templates.
 */
class DiscountedProducts extends CPortlet
{

	public $limit = 6;

	public function getProducts()
	{
		$discountedQuery = new CDbExpression('(SELECT 1 FROM variant variant WHERE variant.product_id=product.id AND variant.compare_price>0 LIMIT 1) = 1');

		return Product::model()->findAll(array(
			'with' => array('variants', 'images'),
			'condition' => 'product.status=1 AND ' . $discountedQuery,
			'order' => 'product.create_time DESC',
			'limit' => $this->limit,
		));
	}

	public function run()
	{
		$this->render('discountedProducts');
	}

}
