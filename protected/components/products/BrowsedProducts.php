<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 18:48
 * To change this template use File | Settings | File Templates.
 */
class BrowsedProducts extends CWidget
{

	/**
	 * @var int
	 */
	public $limit = 20;

	/**
	 * @return array|mixed
	 */
	public function getProducts()
	{
		$browsedProducts = isset(Yii::app()->session['browsedProducts']) ?
			Yii::app()->session['browsedProducts'] :
			array();

		$products = array();
		if (!empty($browsedProducts))
		{
			$browsedProductsIds = array_values($browsedProducts);
			$browsedProductsIds = array_reverse($browsedProductsIds);

			if ($this->limit > 0)
				$browsedProductsIds = array_slice($browsedProductsIds, 0, $this->limit);

			$products = Product::model()->findBrowsedProducts($browsedProductsIds, $this->limit);
		}

		return $products;
	}

	/**
	 *
	 */
	public function run()
	{
		$this->render('browsed');
	}

}
