<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 18:31
 * To change this template use File | Settings | File Templates.
 */
class BrandsMenu extends CWidget
{

	public function getBrands()
	{
		return Brand::model()->findAll(array(
			'condition' => 'brand.status=' . Brand::STATUS_ENABLED,
		));
	}

	public function run()
	{
		$this->render('brandsMenu');
	}

}