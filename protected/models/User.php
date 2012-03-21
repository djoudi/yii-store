<?php

class User extends UserBase
{

	/**
	 * @var bool
	 */
	public $rememberMe;

	/**
	 * @var UserIdentity
	 */
	private $_identity;

	/**
	 * @param string $className
	 * @return User
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
			// Login
			array('email, password', 'required', 'on' => 'login'),
			array('email', 'email', 'on' => 'login'),
			array('rememberMe', 'boolean', 'on' => 'login'),
			array('password', 'authenticate', 'on' => 'login'),
			// Register
			array('name, email, password', 'required', 'on' => 'register'),
			array('email', 'email', 'on' => 'register'),
			// profile
			array('name, email', 'required', 'on' => 'profile'),
			array('email', 'email', 'on' => 'profile'),
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
				'rememberMe' => 'Remember me next time',
			)
		);
	}

	/**
	 * @return array
	 */
	public function defaultScope()
	{
		return CMap::mergeArray(
			parent::defaultScope(),
			array(
				'alias' => $this->tableName(),
				'condition' => 'user.status = :status',
				'params' => array(':status' => self::STATUS_ENABLED)
			)
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
				// Hash password
				$this->salt = $this->generateSalt();
				$this->password = $this->hashPassword($this->password, $this->salt);

				$this->create_time = $this->update_time = time();
			}
			else
				$this->update_time = time();

			return true;
		}
		else
			return false;
	}

	/**
	 * @param string
	 * @return boolean
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password, $this->salt) === $this->password;
	}

	/**
	 * @param string
	 * @param string
	 * @return string
	 */
	public function hashPassword($password, $salt)
	{
		return md5($salt . $password);
	}

	/**
	 * @return string
	 */
	protected function generateSalt()
	{
		return md5(uniqid('', true));
	}

	/**
	 * @param $attribute
	 * @param $params
	 */
	public function authenticate($attribute, $params)
	{
		$this->_identity = new UserIdentity($this->email, $this->password);
		if (!$this->_identity->authenticate())
			$this->addError('password', 'Incorrect email or password.');
	}

	/**
	 * @return boolean
	 */
	public function login()
	{
		if ($this->_identity === null)
		{
			$this->_identity = new UserIdentity($this->email, $this->password);
			$this->_identity->authenticate();
		}

		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
		{
			$duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
			Yii::app()->user->login($this->_identity, $duration);
			return true;
		}
		else
			return false;
	}

}