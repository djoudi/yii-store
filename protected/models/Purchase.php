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

}