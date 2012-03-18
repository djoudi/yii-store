<?php

/**
 * This is the model class for table "{{orders}}".
 *
 * The followings are the available columns in table '{{orders}}':
 * @property string $id
 * @property integer $delivery_id
 * @property double $delivery_price
 * @property integer $payment_method_id
 * @property integer $paid
 * @property string $payment_date
 * @property integer $closed
 * @property string $date
 * @property integer $user_id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $comment
 * @property integer $status
 * @property string $url
 * @property string $payment_details
 * @property string $ip
 * @property double $total_price
 * @property string $note
 * @property double $discount
 * @property integer $separate_delivery
 * @property string $modified
 */
class Orders extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{orders}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_date, closed, email, comment, payment_details, ip, total_price, note, discount, modified', 'required'),
			array('delivery_id, payment_method_id, paid, closed, user_id, status, separate_delivery', 'numerical', 'integerOnly'=>true),
			array('delivery_price, total_price, discount', 'numerical'),
			array('name, address, phone, email, url', 'length', 'max'=>255),
			array('comment, note', 'length', 'max'=>1024),
			array('ip', 'length', 'max'=>15),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, delivery_id, delivery_price, payment_method_id, paid, payment_date, closed, date, user_id, name, address, phone, email, comment, status, url, payment_details, ip, total_price, note, discount, separate_delivery, modified', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'delivery_id' => 'Delivery',
			'delivery_price' => 'Delivery Price',
			'payment_method_id' => 'Payment Method',
			'paid' => 'Paid',
			'payment_date' => 'Payment Date',
			'closed' => 'Closed',
			'date' => 'Date',
			'user_id' => 'User',
			'name' => 'Name',
			'address' => 'Address',
			'phone' => 'Phone',
			'email' => 'Email',
			'comment' => 'Comment',
			'status' => 'Status',
			'url' => 'Url',
			'payment_details' => 'Payment Details',
			'ip' => 'Ip',
			'total_price' => 'Total Price',
			'note' => 'Note',
			'discount' => 'Discount',
			'separate_delivery' => 'Separate Delivery',
			'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('delivery_id',$this->delivery_id);
		$criteria->compare('delivery_price',$this->delivery_price);
		$criteria->compare('payment_method_id',$this->payment_method_id);
		$criteria->compare('paid',$this->paid);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('closed',$this->closed);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('payment_details',$this->payment_details,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('separate_delivery',$this->separate_delivery);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}