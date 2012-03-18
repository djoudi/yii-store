<?php

Yii::import('zii.widgets.CPortlet');

/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 19:43
 * To change this template use File | Settings | File Templates.
 */
class FeaturedProducts extends CPortlet
{

	public $limit = 6;

	public function getProducts()
	{
		return Product::model()->findAll(array(
			'with' => array('variants', 'images'),
			'condition' => 't.status=:status AND t.featured=:featured',
			'params' => array(
				':status' => Product::STATUS_ENABLED,
				':featured' => Product::STATUS_ENABLED,
			),
			'order' => 't.position DESC',
			'limit' => $this->limit,
		));
	}

	public function renderContent()
	{
		$this->render('featuredProducts');
	}

}
