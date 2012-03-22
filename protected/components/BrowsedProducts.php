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

	public $limit = 20;

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

			$criteria = new CDbCriteria;
			$criteria->with = array('specifications', 'images');
			$criteria->addInCondition('product.id', $browsedProductsIds);

			$products = Product::model()->findAll($criteria);
		}

		return $products;
	}

	public function run()
	{
		$this->render('browsedProducts');
	}

}
