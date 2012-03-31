<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $id
 * @property string $delivery_id
 * @property double $delivery_price
 * @property string $payment_id
 * @property integer $paid
 * @property string $payment_time
 * @property integer $closed
 * @property string $create_time
 * @property string $user_id
 * @property string $user_name
 * @property string $user_address
 * @property string $user_phone
 * @property string $user_email
 * @property string $comment
 * @property integer $status
 * @property string $payment_details
 * @property string $user_ip
 * @property double $total_price
 * @property string $note
 * @property double $discount
 * @property integer $separate_delivery
 * @property string $update_time
 */
abstract class OrderBase extends CActiveRecord
{

	/**
	 * @return string
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array
	 */
	public function relations()
	{
		return array(
			'purchases' => array(self::HAS_MANY, 'Purchase', 'order_id'),
			'delivery' => array(self::BELONGS_TO, 'Delivery', 'delivery_id'),
			'payment' => array(self::BELONGS_TO, 'Payment', 'payment_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'delivery_id' => 'Delivery',
			'delivery_price' => 'Delivery Price',
			'payment_id' => 'Payment',
			'paid' => 'Paid',
			'payment_time' => 'Payment Time',
			'closed' => 'Closed',
			'create_time' => 'Create Time',
			'user_id' => 'User',
			'user_name' => 'User Name',
			'user_address' => 'User Address',
			'user_phone' => 'User Phone',
			'user_email' => 'User Email',
			'comment' => 'Comment',
			'status' => 'Status',
			'payment_details' => 'Payment Details',
			'user_ip' => 'User Ip',
			'total_price' => 'Total Price',
			'note' => 'Note',
			'discount' => 'Discount',
			'separate_delivery' => 'Separate Delivery',
			'update_time' => 'Update Time',
		);
	}

	/**
	 * @return array
	 */
	public function defaultScope()
	{
		return array(
			'alias' => $this->tableName(),
		);
	}

}