<?php

/**
 * This is the model class for table "variant".
 *
 * The followings are the available columns in table 'variant':
 * @property string $id
 * @property string $product_id
 * @property string $sku
 * @property string $name
 * @property double $price
 * @property double $compare_price
 * @property integer $stock
 * @property string $position
 * @property string $attachment
 */
class Variant extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Variant the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'variant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, sku, name, price, position, attachment', 'required'),
			array('stock', 'numerical', 'integerOnly' => true),
			array('price, compare_price', 'numerical'),
			array('product_id, position', 'length', 'max' => 11),
			array('sku, name, attachment', 'length', 'max' => 255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, sku, name, price, compare_price, stock, position, attachment', 'safe', 'on' => 'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'sku' => 'Sku',
			'name' => 'Name',
			'price' => 'Price',
			'compare_price' => 'Compare Price',
			'stock' => 'Stock',
			'position' => 'Position',
			'attachment' => 'Attachment',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('product_id', $this->product_id, true);
		$criteria->compare('sku', $this->sku, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('price', $this->price);
		$criteria->compare('compare_price', $this->compare_price);
		$criteria->compare('stock', $this->stock);
		$criteria->compare('position', $this->position, true);
		$criteria->compare('attachment', $this->attachment, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}