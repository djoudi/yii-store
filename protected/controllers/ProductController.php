<?php
/**
 * Created by JetBrains PhpStorm.
 * User: evgenijnasyrov
 * Date: 18.03.12
 * Time: 0:26
 * To change this template use File | Settings | File Templates.
 */
class ProductController extends Controller
{

	/**
	 * @return array
	 */
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}

	/**
	 * @param $id
	 * @throws CHttpException
	 */
	public function actionView($id)
	{
		$product = Product::model()->findByPk($id);
		if ($product === null)
			throw new CHttpException(404, 'Запрашиваемая страница не существует.');


		/*
		 * Добавление в историю просмотров товаров
		 */
		$browsedProducts = isset(Yii::app()->session['browsedProducts']) ?
			Yii::app()->session['browsedProducts'] :
			array();

		if (!empty($browsedProducts))
		{
			// Удалим текущий товар, если он был
			if (($key = array_search($product->id, $browsedProducts)) !== false)
				unset($browsedProducts[$key]);
		}

		// Добавим текущий товар
		$browsedProducts[] = $product->id;
		$browsedProductsLimit = Yii::app()->params['browsedProductsLimit'];
		$browsedProducts = array_slice($browsedProducts, -$browsedProductsLimit, $browsedProductsLimit);
		Yii::app()->session['browsedProducts'] = $browsedProducts;

		$options = Feature::model()->with('options')->findAll();


		$this->render('view', array(
			'product' => $product,
			'prevProduct' => Product::model()->findPrevProduct($product->id),
			'nextProduct' => Product::model()->findNextProduct($product->id),
			'comment' => $this->newComment($product),
		));
	}

	/**
	 * @param Product $product
	 * @return Comment
	 */
	public function newComment(Product $product)
	{
		$comment = new Comment('create');

		if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}

		if (isset($_POST['Comment']))
		{
			$comment->attributes = $_POST['Comment'];

			if ($product->addComment($comment))
			{
				Yii::app()->user->setFlash('commentSubmitted', true);
				$this->refresh();
			}
		}

		return $comment;
	}

	/**
	 * @param string $term
	 */
	public function actionSearch($term)
	{
		if (Yii::app()->request->isAjaxRequest)
		{
			$criteria = new CDbCriteria;
			$criteria->with = array('images');
			$criteria->compare('product.name', $term, true);

			$products = array();
			foreach (Product::model()->findAll($criteria) as $model)
			{
				// todo: подлючить картинки
				$products[] = array(
					'label' => $model->name,
					'url' => $model->url,
					'image' => $model->images[0]->file,
				);
			}

			echo CJSON::encode($products);

			Yii::app()->end();
		}
	}

}
