<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 17.03.12
 * Time: 11:52
 * To change this template use File | Settings | File Templates.
 */
class RecentPosts extends CWidget
{

	/**
	 * Кол-во выводимых постов
	 *
	 * @var int
	 */
	public $limit = 5;

	/**
	 * @return Blog
	 */
	public function getPosts()
	{
		return Blog::model()->findRecentPosts($this->limit);
	}

	/**
	 * Отображение портлета
	 */
	public function run()
	{
		$this->render('recent');
	}

}
