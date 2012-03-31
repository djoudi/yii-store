<?php

class Controller extends CController
{

	/**
	 * @var string
	 */
	public $layout = '/layouts/main';

	/**
	 * @var string the page meta title.
	 */
	public $metaTitle;

	/**
	 * @var string the page meta description.
	 */
	public $metaDescription;

	/**
	 * @var string the page meta keywords.
	 */
	public $metaKeywords;

	/**
	 * @return mixed
	 */
	public function getPage()
	{
		$page = Page::model()->find(array(
			'condition' => 'controller = :controller AND action = :action',
			'params' => array(
				':controller' => $this->id,
				':action' => $this->action->id,
			),
		));

		if ($page)
		{
			$this->metaTitle = $page->meta_title;
			$this->metaKeywords = $page->meta_keywords;
			$this->metaDescription = $page->meta_description;
		}

		return $page;
	}

}