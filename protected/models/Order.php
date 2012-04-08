<?php

class Order extends OrderBase
{

	/**
	 * @param string $className
	 * @return Order
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return array(
			// create
			array('user_name, user_email, user_phone, user_address', 'required', 'on' => 'create'),
			array('user_email', 'email', 'on' => 'create'),
			array('delivery_id', 'exist', 'className' => 'Delivery', 'attributeName' => 'id', 'on' => 'create'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return CMap::mergeArray(
			parent::attributeLabels(),
			array(
				'user_name' => 'Имя, фамилия',
				'user_email' => 'Email',
				'user_phone' => 'Телефон',
				'user_address' => 'Адрес доставки',
				'comment' => 'Комментарий к заказу',
			)
		);
	}

	/**
	 * @return bool
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->create_time = $this->update_time = time();
				$this->user_ip = Yii::app()->request->userHostAddress;

				if (!Yii::app()->user->isGuest)
					$this->user_id = Yii::app()->user->id;
			}
			else
				$this->update_time = time();

			return true;
		}
		else
			return false;
	}

	/**
	 * Добавление товаров к заказу
	 *
	 * @param $variantId
	 * @param $amount
	 * @return bool
	 */
	public function addPurchase($variantId, $amount)
	{
		// проверка варианта
		$variant = ProductVariant::model()->findByPk($variantId);
		if ($variant === null)
			return false;

		// проверка продукта
		$product = Product::model()->findByPk($variant->product_id);
		if ($product === null)
			return false;

		// новый заказанный продукт
		$purchase = new Purchase('create');
		$purchase->order_id = $this->id;

		// инфо о варианте
		$purchase->variant_id = $variant->id;
		$purchase->variant_name = $variant->name;
		$purchase->price = $variant->price;
		$purchase->amount = $amount;

		// инфо о продукте
		$purchase->product_id = $product->id;
		$purchase->product_name = $product->name;

		return $purchase->save();
	}

	/**
	 * Добавление информации о доставке
	 *
	 * @return bool
	 */
	public function updateDelivery()
	{
		$delivery = Delivery::model()->findByPk($this->delivery_id);
		if ($delivery === null)
			return false;
		$this->delivery_price = $delivery->price;
		$this->separate_delivery = $delivery->separate;
		return $this->save();
	}

}