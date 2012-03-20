<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 18:36
 * To change this template use File | Settings | File Templates.
 */
class CurrenciesMenu extends CWidget
{

	public function getCurrencies()
	{
		$currencies = Currency::model()->findAll(array(
			'condition' => 'currency.status=:status',
			'params' => array(':status' => Currency::STATUS_ENABLED),
		));

		$items = array();
		foreach ($currencies as $currency)
		{
			$items[] = array(
				'label' => $currency->name,
				'url' => array(Yii::app()->controller->route, 'currency_id' => $currency->id),
			);
		}

		return $items;
	}

	public function run()
	{
		$this->render('currenciesMenu');
	}

}
