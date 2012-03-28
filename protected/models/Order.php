<?php

class Order extends CActiveRecord
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

}