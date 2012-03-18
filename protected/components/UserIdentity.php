<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	/**
	 * @var int
	 */
	private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = Users::model()->find(array(
			'condition' => 't.enabled=1 AND t.email=:email',
			'params' => array(':email' => $this->username),
		));

		if ($user === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if (!$user->validatePassword($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id = $user->id;
			$this->setState('name', $user->name);
			$this->setState('discount', $user->group_id ? $user->group->discount : 0);

			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode == self::ERROR_NONE;
	}

	/**
	 * the ID of the user record
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->_id;
	}

}