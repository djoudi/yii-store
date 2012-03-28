<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Евгений
 * Date: 28.03.12
 * Time: 10:19
 * To change this template use File | Settings | File Templates.
 */
class CartController extends CController
{

	/**
	 *
	 */
	public function actionIndex()
	{
		$order = new Order('create');
		if (isset($_POST['Order']))
		{
			$order->attributes = $_POST['Order'];
			if ($order->save())
			{
				$this->refresh();
			}
		}
		elseif (isset($_POST['amounts']))
		{
			if (is_array($_POST['amounts']))
			{
				foreach ($_POST['amounts'] as $specificationId => $amount)
					Yii::app()->cart->update($specificationId, $amount);

				$this->redirect('/cart/index');
			}
		}

		$this->render('index', array(
			// корзина
			'purchases' => Yii::app()->cart->purchases,
			'totalPrice' => Yii::app()->cart->totalPrice,
			'totalProducts' => Yii::app()->cart->totalProducts,
			// доставка
			'deliveries' => Delivery::model()->findAll(),
			// заказ
			'order' => $order,
		));
	}

	/**
	 * Добавление в корзину
	 *
	 * @param $variant
	 * @param $amount
	 */
	public function actionCreate($variant, $amount = 1)
	{
		Yii::app()->cart->create($variant, $amount);
		$this->redirect('/cart/index');
	}

	/**
	 * Добавление в корзину
	 *
	 * @param $variant
	 */
	public function actionDelete($variant)
	{
		Yii::app()->cart->delete($variant);
		$this->redirect('/cart/index');
	}

}