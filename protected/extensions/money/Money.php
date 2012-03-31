<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 31.03.12
 * Time: 11:05
 * To change this template use File | Settings | File Templates.
 */
class Money extends CComponent
{

	/**
	 * Все валюты
	 *
	 * @var array
	 */
	private $_list = array();

	/**
	 * Текущая валюта
	 *
	 * @var Currency
	 */
	private $_current;

	/**
	 * Инициализация
	 */
	public function init()
	{
		// Все валюты
		$this->_list = Currency::model()->findAll();

		// Выбор текущей валюты
		if ($currencyId = Yii::app()->request->getParam('currencyId'))
			Yii::app()->session['currencyId'] = $currencyId;

		// Берем валюту из сессии
		if (isset(Yii::app()->session['currencyId']))
			$this->_current = Currency::model()->findByPk(Yii::app()->session['currencyId']);
		// Или первую из списка
		else
			$this->_current = reset($this->_list);
	}

	/**
	 * Форматирование цены
	 *
	 * @param $price
	 * @return string
	 */
	public function convert($price)
	{
		// Умножим на курс валюты
		$price = $price * $this->_current->rate_from / $this->_current->rate_to;

		// Форматирование цены
		return number_format(
			$price,
			$this->_current->cents,
			Yii::app()->params['decimalsPoint'],
			Yii::app()->params['thousandsSeparator']
		);
	}

	/**
	 * Все валюты
	 *
	 * @return array
	 */
	public function getList()
	{
		return $this->_list;
	}

	/**
	 * Текущая валюта
	 *
	 * @return Currency
	 */
	public function getCurrent()
	{
		return $this->_current;
	}

}
