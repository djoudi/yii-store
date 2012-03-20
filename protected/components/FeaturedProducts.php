<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 19:43
 * To change this template use File | Settings | File Templates.
 */
class FeaturedProducts extends CWidget
{

	public $limit = 6;

	public function getProducts()
	{
		return Product::model()->findAll(array(
			'with' => array('variants', 'images'),
			'condition' => 'product.status=:status AND product.featured=:featured',
			'params' => array(
				':status' => Product::STATUS_ENABLED,
				':featured' => Product::STATUS_ENABLED,
			),
			'limit' => $this->limit,
		));
	}

	public function run()
	{
		$this->render('featuredProducts');
	}

}
