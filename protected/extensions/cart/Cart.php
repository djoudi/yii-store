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

			$variantsCriteria = new CDbCriteria;
			$variantsCriteria->addInCondition('product_variant.id', $sessionItemsIds);
			$variants = ProductVariant::model()->findAll($variantsCriteria);

			if (count($variants))
			{
				$items = $productsIds = array();
				foreach ($variants as $variant)
				{
					$items[$variant->id]['variant'] = $variant;
					$items[$variant->id]['amount'] = $sessionItems[$variant->id];
					$productsIds[] = $variant->product_id;
				}

				$productsCriteria = new CDbCriteria;
				$productsCriteria->addInCondition('product.id', $productsIds);
				$products = array();
				foreach (Product::model()->findAll($productsCriteria) as $product)
					$products[$product->id] = $product;

				foreach ($items as $variantId => $item)
				{
					$purchase = array();

					if (isset($products[$item['variant']->product_id]))
					{
						$purchase['product'] = $products[$item['variant']->product_id];
						$purchase['variant'] = $item['variant'];
						$purchase['amount'] = $item['amount'];

						$this->_purchases[] = $purchase;
						$this->_totalPrice += $item['variant']->price * $item['amount'];
						$this->_totalProducts += $item['amount'];
					}
				}
			}
		}
	}

	/**
	 * Добавление товара в корзину
	 *
	 * @param $variantId
	 * @param int $amount
	 */
	public function create($variantId, $amount = 1)
	{
		$amount = max(1, intval($amount));

		if (isset(Yii::app()->session['cart'][$variantId]))
			$amount = max(1, $amount + Yii::app()->session['cart'][$variantId]);

		$variant = ProductVariant::model()->findByPk($variantId);

		if ($variant && $variant->stock > 0)
		{
			$amount = min($amount, $variant->stock);

			$cart = Yii::app()->session['cart'];
			$cart[$variant->id] = $amount;
			Yii::app()->session['cart'] = $cart;
		}
	}

	/**
	 * Обновление кол-ва товара
	 *
	 * @param $variantId
	 * @param int $amount
	 */
	public function update($variantId, $amount = 1)
	{
		$amount = max(1, intval($amount));

		$variant = ProductVariant::model()->findByPk($variantId);

		if ($variant && $variant->stock > 0)
		{
			$amount = min($amount, $variant->stock);

			$cart = Yii::app()->session['cart'];
			$cart[$variant->id] = $amount;
			Yii::app()->session['cart'] = $cart;
		}
	}

	/**
	 * Удаление товара из корзины
	 *
	 * @param $variantId
	 */
	public function delete($variantId)
	{
		$cart = Yii::app()->session['cart'];
		unset($cart[$variantId]);
		Yii::app()->session['cart'] = $cart;
	}

	/**
	 * Очистка корзины
	 */
	public function deleteAll()
	{
		unset(Yii::app()->session['cart']);
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