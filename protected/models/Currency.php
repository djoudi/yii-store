<?php

class Currency extends CurrencyBase
{

	/**
	 * @param string $className
	 * @return Currency
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * @return array
	 */
	public function defaultScope()
	{
		return CMap::mergeArray(
			parent::defaultScope(),
			array(
				'condition' => 'currency.status = :status',
				'params' => array(':status' => Currency::STATUS_ENABLED),
				'order' => 'currency.position',
			)
		);
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('site/index', array(
			'currencyId' => $this->id,
		));
	}

}