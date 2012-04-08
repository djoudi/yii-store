<?php

class Purchase extends PurchaseBase
{

	/**
	 * @param string $className
	 * @return Purchase
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return array(
			// create
			array('order_id, product_id, variant_id, price, amount', 'required', 'on' => 'create'),
			array('order_id, product_id, variant_id, amount', 'numerical', 'integerOnly' => true, 'on' => 'create'),
			array('price', 'numerical', 'integerOnly' => false, 'on' => 'create'),
		);
	}

}