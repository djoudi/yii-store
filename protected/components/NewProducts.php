<?php

Yii::import('zii.widgets.CPortlet');

/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 20:16
 * To change this template use File | Settings | File Templates.
 */
class NewProducts extends CPortlet
{

	public $limit = 6;

	public function getProducts()
	{
		return Product::model()->findAll(array(
			'with' => array('variants', 'images'),
			'condition' => 't.status=' . Product::STATUS_ENABLED,
			'order' => 't.create_time DESC',
			'limit' => $this->limit,
		));
	}

	public function renderContent()
	{
		$this->render('newProducts');
	}

}
