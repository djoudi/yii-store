<?php

class Specification extends SpecificationBase
{

	/**
	 * @param string $className
	 * @return Specification
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
				'order' => 'specification.position',
			)
		);
	}

}