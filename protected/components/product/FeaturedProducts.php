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

	/**
	 * @var int
	 */
	public $limit = 6;

	/**
	 * @return mixed
	 */
	public function getProducts()
	{
		return Product::model()->findFeaturedProducts($this->limit);
	}

	/**
	 *
	 */
	public function run()
	{
		$this->render('featured');
	}

}
