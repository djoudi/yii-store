<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 17:48
 * To change this template use File | Settings | File Templates.
 */
class CategoriesMenu extends CWidget
{

	/**
	 * @return array
	 */
	public function getCategories()
	{
		$categories = Category::model()->findAll(array(
			'order' => 'category.parent_id, category.position',
		));
		return $this->_getItems($categories, 0);
	}

	/**
	 *
	 */
	public function run()
	{
		$this->render('categoriesMenu');
	}

	/**
	 * @param array $categories
	 * @param int $parent_id
	 * @return array
	 */
	private function _getItems(array $categories, $parent_id = 0)
	{
		$items = array();
		foreach ($categories as $category)
		{
			if ($category->parent_id == $parent_id)
			{
				$items[] = array(
					'label' => $category->name,
					'url' => array('category/view','id'=>$category->id,'name'=>$category->name),
					'items' => $this->_getItems($categories, $category->id)
				);
			}
		}

		return $items;
	}

}
