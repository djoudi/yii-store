<?php

Yii::import('zii.widgets.CPortlet');

/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 12:13
 * To change this template use File | Settings | File Templates.
 */
class PagesMenu extends CPortlet
{

	/**
	 * Формируем главное меню
	 *
	 * @return mixed
	 */
	public function getPages()
	{
		$pages = Page::model()->findAll(array(
			'condition' => 'page.menu_id=:menu_id AND page.status=:status',
			'params' => array(
				':menu_id' => 1,
				':status' => Page::STATUS_ENABLED,
			),
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
