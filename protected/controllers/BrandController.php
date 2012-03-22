<?php

/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 20.03.12
 * Time: 20:59
 * To change this template use File | Settings | File Templates.
 */
class BrandController extends Controller
{

	/**
	 * @var Brand
	 */
	private $_model;

	/**
	 * @param $id
	 * @throws CHttpException
	 */
	public function actionView($id)
	{
		$model = Brand::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'Запрашиваемая страница не существует.');

		$products = new CActiveDataProvider('Product', array(
			'criteria' => array(
				'with' => array('specifications', 'images'),
				'condition' => 'product.brand_id = :brand_id',
				'params' => array(':brand_id' => $id),
			),
			'pagination' => array(
				'pageSize' => 20,
			),
		));

		$this->render('view', array(
			'model' => $model,
			'products' => $products,
		));
	}

}
