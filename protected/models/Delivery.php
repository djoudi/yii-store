<?php

class Delivery extends DeliveryBase
{

	/**
	 * @param string $className
	 * @return Delivery
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}