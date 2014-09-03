<?php




/*
CREATE TABLE users (
	id int(11) NOT NULL AUTO_INCREMENT,
	username varchar(50) NOT NULL,
	password char(60) NOT NULL,
	role varchar(20) NOT NULL,
	PRIMARY KEY (id)
);
*/
namespace Nesys;

use Nette, Nette\Security,
	Nette\Utils\Strings;
/**
 * Users authenticator.
 * @version API-1
 */
class Authenticator extends Nette\Object implements Security\IAuthenticator
{
	/** @var Nette\Database\Connection */
	private $database;
	private $core;


	public function __construct(Nette\Database\Connection $database, \Nesys\NesysCore $core)
	{
		$this->database = $database;
		$this->core = $core;
	}



	/**
	 * Performs an authentication.
	 * @version API-1
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		$row = $this->database->table('users')->where('user', $username)->fetch();

		if (!$row) {
			throw new Security\AuthenticationException('Uživatelské jméno je neplatné.', self::IDENTITY_NOT_FOUND);
		}
		
		//if ($row->pass !== $this->calculateHash($password, $row->pass)) {
		if ($row->pass !== md5($password)) {
			throw new Security\AuthenticationException('Nesprávné heslo.', self::INVALID_CREDENTIAL);
		}
		
		if ($row->banned == true) {
			throw new Security\AuthenticationException('Tento uživatel je zabanován z důvodu vážného porušení pravidel.', self::NOT_APPROVED);
		}

		$arr = $row->toArray();
		unset($arr['password']);
		$this->core->log(\Nesys\NesysCore::LOG_USER, "Přihlásil se uživatel #$row->id ($row->user) z ".$_SERVER["REMOTE_ADDR"]);
		return new Nette\Security\Identity($row->id, $row->role, $arr);
	}



	/**
	 * Computes salted password hash.
	 * @param  string
	 * @return string
	 * @deprecated
	 */
	public static function calculateHash($password, $salt = NULL)
	{
		if ($password === Strings::upper($password)) { // perhaps caps lock is on
			$password = Strings::lower($password);
		}
		return crypt($password, $salt ?: '$2a$07$' . Strings::random(22));
	}

}
