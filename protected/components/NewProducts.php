<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 20:16
 * To change this template use File | Settings | File Templates.
 */
class NewProducts extends CWidget
{

	public $limit = 6;

	public function getProducts()
	{
		return Product::model()->findAll(array(
			'with' => array('specifications', 'images'),
			'order' => 'product.create_time DESC',
			'limit' => $this->limit,
		));
	}

	public function run()
	{
		$this->render('newProducts');
	}

}
