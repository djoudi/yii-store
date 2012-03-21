<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Евгений
 * Date: 21.03.12
 * Time: 13:09
 * To change this template use File | Settings | File Templates.
 */
class ProductSearch extends CWidget
{

	/**
	 * @var Product
	 */
	private $_model;

	/**
	 * @return Product
	 */
	public function getModel()
	{
		if (null === $this->_model)
			$this->_model = new Product('search');
		return $this->_model;
	}

	/**
	 *
	 */
	public function run()
	{
		$this->render('productSearch');
	}

}