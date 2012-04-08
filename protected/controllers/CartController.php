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
			$transaction = $order->dbConnection->beginTransaction();
			try
			{
				// Добавляем заказ в базу
				$order->attributes = $_POST['Order'];
				if ($order->validate())
				{
					$order->total_price = Yii::app()->cart->totalPrice;
					$order->save(false);

					// Добавляем товары к заказу
					foreach ($_POST['amounts'] as $variantId => $amount)
						$order->addPurchase($variantId, $amount);

					// Стоимость доставки
					$order->updateDelivery();

					//  очищаем и переходим на заказ
					Yii::app()->cart->deleteAll();

					$transaction->commit();

					// Перенаправляем на страницу заказа

				}

			}
			catch (Exception $e)
			{
				$transaction->rollBack();

				//you should do sth with this exception (at least log it or show on page)
				Yii::log('Exception when saving data: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
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