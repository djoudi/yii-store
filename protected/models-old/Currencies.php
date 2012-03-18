<?php

/**
 * This is the model class for table "{{currencies}}".
 *
 * The followings are the available columns in table '{{currencies}}':
 * @property integer $id
 * @property string $name
 * @property string $sign
 * @property string $code
 * @property double $rate_from
 * @property double $rate_to
 * @property integer $cents
 * @property integer $position
 * @property integer $enabled
 */
class Currencies extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Currencies the static model class
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
		return '{{currencies}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sign, position, enabled', 'required'),
			array('cents, position, enabled', 'numerical', 'integerOnly'=>true),
			array('rate_from, rate_to', 'numerical'),
			array('name', 'length', 'max'=>255),
			array('sign', 'length', 'max'=>20),
			array('code', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, sign, code, rate_from, rate_to, cents, position, enabled', 'safe', 'on'=>'search'),
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
			'enabled' => 'Enabled',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sign',$this->sign,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('rate_from',$this->rate_from);
		$criteria->compare('rate_to',$this->rate_to);
		$criteria->compare('cents',$this->cents);
		$criteria->compare('position',$this->position);
		$criteria->compare('enabled',$this->enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}