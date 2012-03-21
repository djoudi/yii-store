<?php

class Controller extends CController
{

	/**
	 * @var string
	 */
	public $layout = '/layouts/main';

	/**
	 * @var string
	 */
	public $pageKeywords;

	/**
	 * @var string
	 */
	public $pageDescription;

	/**
	 * @return mixed
	 */
	public function getPage()
	{
		$page = Page::model()->find(array(
			'condition' => 'controller=:controller AND action=:action',
			'params' => array(
				':controller' => $this->id,
				':action' => $this->action->id,
			),
		));

		if ($page)
		{
			$this->pageTitle = $page->meta_title;
			$this->pageKeywords = $page->meta_keywords;
			$this->pageDescription = $page->meta_description;
		}

		return $page;
	}

}