<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 12:13
 * To change this template use File | Settings | File Templates.
 */
class PagesMenu extends CWidget
{

	/**
	 * Формируем главное меню
	 *
	 * @return mixed
	 */
	public function getPages()
	{
		$pages = Page::model()->findAll(array(
			'condition' => 'page.menu_id = :menu_id',
			'params' => array(':menu_id' => 1),
		));

		$menu = array();
		foreach ($pages as $page)
		{
			$menu[] = array(
				'label' => $page->name,
				'url' => $page->url,
			);
		}

		return $menu;
	}

	/**
	 * Отображение портлета
	 */
	public function run()
	{
		$this->render('pagesMenu');
	}

}
