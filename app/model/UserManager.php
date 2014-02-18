<?php

namespace App;

use Nette,
	Nette\Utils\Strings;


/**
 * Users management.
 */
class UserManager extends Nette\Object implements Nette\Security\IAuthenticator
{
	const
		TABLE_NAME = 'user',
		COLUMN_ID = 'id',
		COLUMN_NAME = 'username',
		COLUMN_PASSWORD_HASH = 'password',
		COLUMN_ROLE = 'role',
		COLUMN_IP = "ip",
		AUTH_SERVICE = "auth_service",
		AUTH_TOKEN = "auth_token";


	/** @var Nette\Database\Context */
	private $database;


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$password = self::removeCapsLock($password);

		$row = $this->database->table(self::TABLE_NAME)
				->where(self::AUTH_SERVICE, "songator")
				->where(self::COLUMN_NAME, $username)
				->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);

		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);

		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update(array(
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			));
		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
	}


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @return void
	 */
	public function add($username, $password)
	{
		$this->database->table(self::TABLE_NAME)->insert(array(
			self::COLUMN_NAME => $username,
			self::COLUMN_PASSWORD_HASH => Passwords::hash(self::removeCapsLock($password)),
			self::COLUMN_ROLE => "user",
			self::AUTH_SERVICE => "songator"
		));
	}
	
	/**
	 * Adds new user via Twitter service
	 * @param string
	 * @param string
	 * @return \Nette\Database\Table\ActiveRow
	 */
	public function addViaTwitter($username, $token) {
		return $this->database->table(self::TABLE_NAME)->insert(array(
				self::AUTH_SERVICE => "twitter",
				self::COLUMN_NAME => $username,
				self::AUTH_TOKEN => $token,
				self::COLUMN_ROLE => "user",
			));
	}
	
	/**
	 * Gets user by service and auth token
	 * @param string
	 * @param string
	 * @return \Nette\Database\Table\ActiveRow
	 */
	public function getByServiceToken($service, $token) {
		return $this->database->table(self::TABLE_NAME)
			->where(self::AUTH_SERVICE, $service)
			->where(self::AUTH_TOKEN, $token)
			->fetch();
	}

	/**
	 * Fixes caps lock accidentally turned on.
	 * @return string
	 */
	private static function removeCapsLock($password)
	{
		return $password === Strings::upper($password)
			? Strings::lower($password)
			: $password;
	}

}
