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
			'condition' => 't.menu_id=1 AND t.status=1',
			'order' => 't.position',
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
	public function renderContent()
	{
		$this->render('pagesMenu');
	}

}
