<?php

Yii::import('zii.widgets.CPortlet');

/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 18:31
 * To change this template use File | Settings | File Templates.
 */
class BrandsMenu extends CPortlet
{

	public function getBrands()
	{
		return Brand::model()->findAll(array(
			'condition' => 't.status=' . Brand::STATUS_ENABLED,
			'order' => 't.name',
		));
	}

	public function renderContent()
	{
		$this->render('brandsMenu');
	}

}
