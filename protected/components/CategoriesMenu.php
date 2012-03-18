<?php

Yii::import('zii.widgets.CPortlet');

/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 17:48
 * To change this template use File | Settings | File Templates.
 */
class CategoriesMenu extends CPortlet
{

	public function getCategories()
	{
		$categories = Category::model()->findAll(array(
			'condition' => 't.status=' . Category::STATUS_ENABLED,
			'order' => 't.parent_id, t.position',
		));

		return $this->_getItems($categories, 0);
	}

	public function renderContent()
	{
		$this->render('categoriesMenu');
	}

	private function _getItems(array $categories, $parent_id = 0)
	{
		$items = array();
		foreach ($categories as $category)
		{
			if ($category->parent_id == $parent_id)
			{
				$items[] = array(
					'label' => $category->name,
					'url' => $category->url,
					'items' => $this->_getItems($categories, $category->id)
				);
			}
		}

		return $items;
	}

}
