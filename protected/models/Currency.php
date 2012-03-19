<?php

/**
 * This is the model class for table "currency".
 *
 * The followings are the available columns in table 'currency':
 * @property string $id
 * @property string $name
 * @property string $sign
 * @property string $code
 * @property double $rate_from
 * @property double $rate_to
 * @property integer $cents
 * @property string $position
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 */
class Currency extends CActiveRecord
{

	const STATUS_DISABLED = 0;
	const STATUS_ENABLED = 1;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Currency the static model class
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
		return 'currency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, sign, code, position, create_time, update_time', 'required'),
			array('cents, status', 'numerical', 'integerOnly' => true),
			array('rate_from, rate_to', 'numerical'),
			array('name', 'length', 'max' => 255),
			array('sign', 'length', 'max' => 20),
			array('code', 'length', 'max' => 3),
			array('position, create_time, update_time', 'length', 'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, sign, code, rate_from, rate_to, cents, position, status, create_time, update_time', 'safe', 'on' => 'search'),
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
			'name' => 'Name',
			'sign' => 'Sign',
			'code' => 'Code',
			'rate_from' => 'Rate From',
			'rate_to' => 'Rate To',
			'cents' => 'Cents',
			'position' => 'Position',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		);
	}

	/**
	 * Default scope
	 *
	 * @return array
	 */
	public function defaultScope()
	{
		return array(
			'alias' => $this->tableName(),
			'order' => 'currency.position',
		);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl(Yii::app()->request->url, array(
			'currency_id' => $this->id,
		));
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
		$criteria->compare('name', $this->name, true);
		$criteria->compare('sign', $this->sign, true);
		$criteria->compare('code', $this->code, true);
		$criteria->compare('rate_from', $this->rate_from);
		$criteria->compare('rate_to', $this->rate_to);
		$criteria->compare('cents', $this->cents);
		$criteria->compare('position', $this->position, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('update_time', $this->update_time, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}