<?php

Yii::import('zii.widgets.CPortlet');

/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 18:36
 * To change this template use File | Settings | File Templates.
 */
class CurrenciesMenu extends CPortlet
{

	public function getCurrencies()
	{
		$currencies = Currency::model()->findAll(array(
			'condition' => 't.status=' . Currency::STATUS_ENABLED,
			'order' => 't.position',
		));

		$items = array();
		foreach ($currencies as $currency)
		{
			$items[] = array(
				'label' => $currency->name,
				'url' => array('site/index', 'currency_id' => $currency->id),
			);
		}

		return $items;
	}

	public function renderContent()
	{
		$this->render('currenciesMenu');
	}

}
