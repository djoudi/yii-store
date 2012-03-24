<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Евгений
 * Date: 22.03.12
 * Time: 13:12
 * To change this template use File | Settings | File Templates.
 */
class CategoryController extends Controller
{

	public function actionView($id)
	{
		$category = Category::model()->findByPk($id);
		if ($category === null)
			throw new CHttpException(404, 'Запрашиваемая страница не существует.');

		$brands = Brand::model()->findAll(array(
			'with' => array(
				'categories' => array(
					'select' => false,
				),
			),
			'condition' => 'product_category.category_id = :category_id',
			'params' => array(':category_id' => $category->id),
		));

		$products = new CActiveDataProvider('Product', array(
			'criteria' => array(
				'with' => array(
					'images',
					'specifications',
					'categories' => array(
						'select' => false,
						'together' => true,
					),
				),
				'condition' => 'product_category.category_id = :category_id',
				'params' => array(':category_id' => $category->id),
			),
		));

		$this->render('view', array(
			'category' => $category,
			'brands' => $brands,
			'products' => $products,
		));
	}

}
