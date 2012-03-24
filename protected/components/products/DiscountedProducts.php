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

	/**
	 * @var int
	 */
	public $limit = 6;

	/**
	 * @return mixed
	 */
	public function getProducts()
	{
		return Product::model()->findDiscountedProducts($this->limit);
	}

	/**
	 *
	 */
	public function run()
	{
		$this->render('discounted');
	}

}
