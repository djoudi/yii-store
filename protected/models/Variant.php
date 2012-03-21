<?php

class Variant extends VariantBase
{

	/**
	 * @param string $className
	 * @return Variant
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
				'order' => 'variant.position',
			)
		);
	}

}