<?php

class Page extends PageBase
{

	/**
	 * @param string $className
	 * @return Page
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
				'condition' => 'page.status = :status',
				'params' => array(':status' => Page::STATUS_ENABLED),
				'order' => 'page.position',
			)
		);
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('<controller>/<action>', array(
			'controller' => $this->controller,
			'action' => $this->action,
		));
	}

}