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
	 * Удаление позиции из корзины
	 *
	 * @param $id
	 */
	public function actionDelete($id)
	{
		Yii::app()->cart->delete($id);
		$this->redirect('/cart/index');
	}

	/**
	 * Корзина товаров
	 */
	public function actionIndex()
	{
		$order = new Order('create');

		// заказ
		if (isset($_POST['Order']) && isset($_POST['checkout']))
		{
			$order->attributes = $_POST['Order'];
			if ($order->save())
			{
				Yii::app()->session['orderId'] = $order->id;

				foreach ($_POST['amounts'] as $variantId => $amount)
				{
					$purchase = new Purchase('create');
					$purchase->order_id = $order->id;
					$purchase->variant_id = $variantId;
					$purchase->amount = $amount;
					$purchase->save();
				}

				//  очищаем и переходим на заказ
				Yii::app()->cart->deleteAll();
				$this->redirect($this->createUrl('order/view', array(
					'id' => $order->id,
				)));
			}
		}
		// обновление корзины
		elseif (isset($_POST['amounts']) && is_array($_POST['amounts']))
		{
			foreach ($_POST['amounts'] as $variantId => $amount)
				Yii::app()->cart->update($variantId, $amount);

			$this->refresh();
		}

		$deliveries = Delivery::model()->findAll(array(
			'order' => 'delivery.position',
		));

		$this->render('index', array(
			'deliveries' => $deliveries,
			'order' => $order,
		));
	}

}