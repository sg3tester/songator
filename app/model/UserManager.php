<?php

namespace App;

use Nette,
	Nette\Utils\Strings;

/**
 * Users management.
 */
class UserManager extends Nette\Object implements Nette\Security\IAuthenticator {

	const
			TABLE_NAME = 'user',
			PROFILE_TABLE = 'profile',
			COLUMN_ID = 'id',
			COLUMN_NAME = 'username',
			COLUMN_PASSWORD_HASH = 'password',
			COLUMN_ROLE = 'role',
			COLUMN_IP = "ip",
			COLUMN_EMAIL = "email",
			AUTH_SERVICE = "auth_service",
			AUTH_TOKEN = "auth_token";

	/** @var Nette\Database\Context */
	private $database;

	/** @event 
	 *  @param $userManager 
	 *  @param $user
	 *  @param $service
	 */
	public $onUserAdd = [];

	public function __construct(Nette\Database\Context $database) {
		$this->database = $database;
	}

	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials) {
		list($username, $password) = $credentials;

		$row = $this->database->table(self::TABLE_NAME)
				->where(self::AUTH_SERVICE, "songator")
				->where(self::COLUMN_NAME . ' = ? OR ' . self::COLUMN_EMAIL . ' = ?', $username, $username)
				->fetch();
		$hash = Passwords::hash($password);
		/* dump($hash);
		  dump(Passwords::verify($password, $hash)); */
		if (!$row) {
			throw new Nette\Security\AuthenticationException('Uživatelské jméno nebo email nejsou platné', self::IDENTITY_NOT_FOUND);
		} elseif (!Passwords::verify($password, $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('Neplatné heslo', self::INVALID_CREDENTIAL);
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
	public function add($username, $password, $email) {
		$row = $this->database->table(self::TABLE_NAME)
				->select("username, email")
				->where("username = ? OR email = ?", $username, $email)
				->fetch();
		if ($row) {
			if ($row->username == $username)
				throw new UserManagerException("Uživatel $username již existuje", 44);
			if ($row->email == $email)
				throw new UserManagerException("Email $email již někdo používá", 44);
			throw new UserManagerException("Chyba při registraci uživatele: Duplicitní uživatel", 45);
		}
		$user = $this->database->table(self::TABLE_NAME)->insert(array(
			self::COLUMN_NAME => $username,
			self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			self::COLUMN_ROLE => "user",
			self::AUTH_SERVICE => "songator",
			self::COLUMN_EMAIL => $email
		));
		$this->onUserAdd($this, $user, 'songator');
		return $user;
	}

	/**
	 * Adds new user via Twitter service
	 * @param string
	 * @param string
	 * @return \Nette\Database\Table\ActiveRow
	 */
	public function addViaTwitter($username, $token) {
		//TODO: handle onUserAdd event with service Twitter
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
	 * Create a user profile
	 * @param int $id
	 * @param array $data
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function update($id, $data) {
		return $this->database->table(self::TABLE_NAME)->get($id)->update($data);
	}

	public function getUser($id) {
		return $this->database->table(self::TABLE_NAME)->get($id);
	}

	/**
	 * Fixes caps lock accidentally turned on.
	 * @return string
	 */
	private static function removeCapsLock($password) {
		return $password === Strings::upper($password) ? Strings::lower($password) : $password;
	}

	public function getUsers() {
		return $this->database->table(self::TABLE_NAME);
	}

	public function changePassword($id, $password) {
		return $this->getUser($id)->update([
					self::COLUMN_PASSWORD_HASH => Passwords::hash($password)
		]);
	}

}

class UserManagerException extends Nette\InvalidStateException {
	
}
