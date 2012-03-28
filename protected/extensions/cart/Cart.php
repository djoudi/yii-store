<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Евгений
 * Date: 28.03.12
 * Time: 10:21
 * To change this template use File | Settings | File Templates.
 */
class Cart extends CComponent
{

	private $_purchases = array();
	private $_totalPrice = 0;
	private $_totalProducts = 0;

	/**
	 * Обрабатывает коризну
	 */
	public function init()
	{
		if (!empty(Yii::app()->session['cart']))
		{
			$sessionItems = Yii::app()->session['cart'];
			$sessionItemsIds = array_keys($sessionItems);

			$specificationsCriteria = new CDbCriteria;
			$specificationsCriteria->addInCondition('specification.id', $sessionItemsIds);
			$specifications = Specification::model()->findAll($specificationsCriteria);

			if (count($specifications))
			{
				$items = $productsIds = array();
				foreach ($specifications as $specification)
				{
					$items[$specification->id]['specification'] = $specification;
					$items[$specification->id]['amount'] = $sessionItems[$specification->id];
					$productsIds[] = $specification->product_id;
				}

				$productsCriteria = new CDbCriteria;
				$productsCriteria->addInCondition('product.id', $productsIds);
				$products = array();
				foreach (Product::model()->findAll($productsCriteria) as $product)
					$products[$product->id] = $product;

				foreach ($items as $specificationId => $item)
				{
					$purchase = array();

					if (isset($products[$item['specification']->product_id]))
					{
						$purchase['product'] = $products[$item['specification']->product_id];
						$purchase['specification'] = $item['specification'];
						$purchase['amount'] = $item['amount'];

						$this->_purchases[] = $purchase;
						$this->_totalPrice += $item['specification']->price * $item['amount'];
						$this->_totalProducts += $item['amount'];
					}
				}
			}
		}
	}

	/**
	 * Добавление товара в корзину
	 *
	 * @param $specificationId
	 * @param int $amount
	 */
	public function create($specificationId, $amount = 1)
	{
		$amount = max(1, intval($amount));

		if (isset(Yii::app()->session['cart'][$specificationId]))
			$amount = max(1, $amount + Yii::app()->session['cart'][$specificationId]);

		$specification = Specification::model()->findByPk($specificationId);

		if ($specification && $specification->stock > 0)
		{
			$amount = min($amount, $specification->stock);

			$cart = Yii::app()->session['cart'];
			$cart[$specification->id] = $amount;
			Yii::app()->session['cart'] = $cart;
		}
	}

	/**
	 * Обновление кол-ва товара
	 *
	 * @param $specificationId
	 * @param int $amount
	 */
	public function update($specificationId, $amount = 1)
	{
		$amount = max(1, intval($amount));

		$specification = Specification::model()->findByPk($specificationId);

		if ($specification && $specification->stock > 0)
		{
			$amount = min($amount, $specification->stock);

			$cart = Yii::app()->session['cart'];
			$cart[$specification->id] = $amount;
			Yii::app()->session['cart'] = $cart;
		}
	}

	/**
	 * Удаление товара из корзины
	 *
	 * @param $specificationId
	 */
	public function delete($specificationId)
	{
		$cart = Yii::app()->session['cart'];
		unset($cart[$specificationId]);
		Yii::app()->session['cart'] = $cart;
	}

	/**
	 * Возвращает коризину
	 *
	 * @return array
	 */
	public function getPurchases()
	{
		return $this->_purchases;
	}

	/**
	 * @return int
	 */
	public function getTotalPrice()
	{
		return $this->_totalPrice;
	}

	/**
	 * @return int
	 */
	public function getTotalProducts()
	{
		return $this->_totalProducts;
	}

}