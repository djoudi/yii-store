<?php

/**
 * This is the model class for table "{{comments}}".
 *
 * The followings are the available columns in table '{{comments}}':
 * @property string $id
 * @property string $date
 * @property string $ip
 * @property integer $object_id
 * @property string $name
 * @property string $text
 * @property string $type
 * @property integer $approved
 */
class Comments extends CActiveRecord
{

	public $verifyCode;

	/**
	 * Returns the static model of the specified AR class
	 *
	 * @param string $className
	 * @return Comments
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * the associated database table name
	 *
	 * @return string
	 */
	public function tableName()
	{
		return '{{comments}}';
	}

	/**
	 * validation rules for model attributes
	 *
	 * @return array
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, text, type', 'required'),
			array('object_id, approved', 'numerical', 'integerOnly' => true),
			array('ip', 'length', 'max' => 20),
			array('name', 'length', 'max' => 255),
			array('type', 'length', 'max' => 7),
			array('date', 'safe'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, ip, object_id, name, text, type, approved', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * relational rules
	 *
	 * @return array
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'post' => array(self::BELONGS_TO, 'Blog', array(
				'type' => 'blog',
				'object_id',
			)),
			'product' => array(self::BELONGS_TO, 'Products', array(
				'type' => 'product',
				'object_id',
			)),
		);
	}

	/**
	 * customized attribute labels (name=>label)
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => 'Date',
			'ip' => 'Ip',
			'object_id' => 'Object',
			'name' => 'Name',
			'text' => 'Text',
			'type' => 'Type',
			'approved' => 'Approved',
			'verifyCode' => 'Verification Code',
		);
	}

	/**
	 * @return bool
	 */
	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->ip = $_SERVER['REMOTE_ADDR'];
				$this->date = new CDbExpression('NOW()');

				$approved = self::model()->find(array(
					'condition' => 'approved=1 AND ip=:ip',
					'params' => array(':ip' => $this->ip),
				));

				if ($approved)
					$this->approved = 1;
			}

			return true;
		}
		else
			return false;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions
	 *
	 * @return CActiveDataProvider
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('date', $this->date, true);
		$criteria->compare('ip', $this->ip, true);
		$criteria->compare('object_id', $this->object_id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('text', $this->text, true);
		$criteria->compare('type', $this->type, true);
		$criteria->compare('approved', $this->approved);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}