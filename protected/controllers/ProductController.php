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

	public function actionView($url)
	{
		$model = Product::model()->find(array(
			'condition' => 't.status=:status AND t.url=:url',
			'params' => array(
				':status' => Product::STATUS_ENABLED,
				':url' => $url,
			),
		));
		if ($model === null)
			throw new CHttpException(404, 'Запрашиваемая страница не существует.');

		// Добавление в историю просмотров товаров
		$maxVisitedProducts = Yii::app()->params['browsedProductsLimit'];
		$browsedProducts = (isset(Yii::app()->request->cookies['browsedProducts']->value)) ?
			Yii::app()->request->cookies['browsedProducts']->value : '';

		if (!empty($browsedProducts))
		{
			$browsedProducts = explode(',', $browsedProducts);
			// Удалим текущий товар, если он был
			if (($exists = array_search($model->id, $browsedProducts)) !== false)
				unset($browsedProducts[$exists]);
		}

		// Добавим текущий товар
		$browsedProducts[] = $model->id;
		$browsedProducts = array_slice($browsedProducts, -$maxVisitedProducts, $maxVisitedProducts);
		$newCookie = new CHttpCookie('browsedProducts', implode(',', $browsedProducts));
		$newCookie->expire = time() + 60 * 60 * 24 * 30; // Время жизни - 30 дней
		Yii::app()->request->cookies['browsedProducts'] = $newCookie;

		$this->render('view', array(
			'model' => $model,
		));
	}

	/**
	 * @param Product $product
	 * @return Comment
	 */
	public function newComment(Product $product)
	{
		$comment = new Comment;

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
}
