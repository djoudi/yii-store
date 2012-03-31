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

	/**
	 * @return array
	 */
	public function defaultScope()
	{
		return CMap::mergeArray(
			parent::defaultScope(),
			array(
				'condition' => 'delivery.status = :status',
				'params' => array(
					':status' => self::STATUS_ENABLED,
				),
			)
		);
	}
}