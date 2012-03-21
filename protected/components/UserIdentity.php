<?php

class UserIdentity extends CBaseUserIdentity
{

	const ERROR_EMAIL_INVALID = 1;

	/**
	 * @var string email
	 */
	public $email;
	/**
	 * @var string password
	 */
	public $password;

	/**
	 * @var int
	 */
	private $_id;

	/**
	 * Constructor.
	 * @param string $email email
	 * @param string $password password
	 */
	public function __construct($email, $password)
	{
		$this->email = $email;
		$this->password = $password;
	}

	/**
	 * Authenticates the user.
	 * The information needed to authenticate the user
	 * are usually provided in the constructor.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->find(array(
			'condition' => 'user.email=:email',
			'params' => array(':email' => $this->email),
		));

		if ($user === null)
			$this->errorCode = self::ERROR_EMAIL_INVALID;
		else if (!$user->validatePassword($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id = $user->id;
			$this->setState('name', $user->name);
			$this->setState('discount', $user->group_id);

			$this->errorCode = self::ERROR_NONE;
		}

		return $this->errorCode == self::ERROR_NONE;
	}

	/**
	 * Returns a value that uniquely represents the identity.
	 * @return int a value that uniquely represents the identity (e.g. primary key value).
	 */
	public function getId()
	{
		return $this->_id;
	}

}