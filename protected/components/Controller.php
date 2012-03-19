<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

	/**
	 * The default layout for the controller view
	 *
	 * @var string
	 */
	public $layout = '/layouts/main';

	public $pageKeywords;
	public $pageDescription;

	public function getPage()
	{
		$page = Page::model()->find(array(
			'condition' => 'status=:status AND controller=:controller AND action=:action',
			'params' => array(
				':status' => Page::STATUS_ENABLED,
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