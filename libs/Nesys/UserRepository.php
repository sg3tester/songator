<?php

namespace Nesys;
/**
 * Description of UserRepository
 *
 * @author JDC
 * @version API-3
 * @since API-1
 * @package NEsys
 * @subpackage API-1
 */
class UserRepository extends Repository {
    
    /*public function __construct(Nette\Database\Connection $db) {
	parent::__construct($db);
    }*/
 protected function setup() {
     $this->tablename = "users";
 }

 /**
  * Register new user in system
  * @param type $user
  * @param type $pass
  * @param type $mail
  * @throws \Nette\Security\AuthenticationException
  * @return \Nette\Database\Table\Selection
  * @version API-1
  */
 public function RegisterUser($user, $pass, $mail) {
	$result = $this->getTable()->where("user = ? OR mail = ?",$user,$mail)->fetch();
	    if ($result->user == $user)
		throw new \Nette\Security\AuthenticationException("Uživatelské jméno je obsazeno!", 5004);
	    if ($result->mail == $mail)
		throw new \Nette\Security\AuthenticationException("Tuto e-mailovou adresu už používá někdo jiný!", 5005);
	$epass = md5($pass);
	return $this->getTable()->insert(array ("user" => $user, "pass" => $epass, "mail" => $mail, "role" => "user"));
    }
    
    /**
     * Změnit roli uživatele
     * @param type $uid
     * @param type $role
     * @return type
     * @version API-1
     */
    public function setRole($uid, $role){
	return $this->getTable()->where("id",$uid)->update(array("role" => $role));
    }
    
    /**
     * Změní pohlaví uživatele
     * @param type $uid
     * @param type $pohlavi
     * @return type
     * @version API-1
     */
    public function setGender($uid, $pohlavi) {
	return $this->getTable()->where("id",$uid)->update(array("pohlavi" => $pohlavi));
    }
    
    /**
     * Zíksat ID uživatele podle jeho username
     * @param type $username
     * @return type
     * @version API-1
     */
    public function getUid($username){
	$usr = $this->getTable()->where("user",$username)->fetch();
	return $usr->id;
    }
    
    /**
     * Get user by id
     * @param int $uid
     * @return \Nette\Database\Table\ActiveRow
     * @version API-1
     */
    public function getUser($uid){
	return $this->getTable()->where("id",$uid)->fetch();
    }
    
    /**
     * 
     * @param int $uid
     * @param string $newname
     * @param string $newmail
     * @return int
     * @version API-1
     */
    public function updateUser($uid, $newname, $newmail){
	return $this->getTable()->where("id",$uid)->update(array("user" => $newname, "mail" => $newmail));
    }

    /**
     * Change users's password
     * @param int $uid
     * @param string $pass
     * @return int
     * @version API-1
     */
    public function changePass($uid, $pass){
	return $this->getTable()->where("id",$uid)->update(array("pass" => md5($pass)));
    }
    
    /**
     * Check password verification
     * @param int $uid
     * @param string $pass
     * @return boolean TRUE if password equals
     * @version API-3
     */
    public function checkPass($uid, $pass) {
	$hash = $this->getTable()->get($uid)->pass;
	
	if (\md5($pass) == $hash)
	    return true;
	else
	    return false;
    }

    /**
     * Vrátí počet všech registrovaých uživatelů
     * @return int
     * @version API-1
     */
    public function getUserCount() {
	return $this->getTable()->count();
    }
    
    /**
     * 
     * @param type $role
     * @return type
     * @version API-1
     */
    public function getRoleCount($role) {
	return $this->getTable()->where("role",$role)->count();
    }
    
    /**
     * Gets list of users
     * @return type
     * @version API-1
     */
    public function getUsers() {
	return $this->getTable()->order("user COLLATE utf8_czech_ci");
    }
    
    /**
     * Delete user from system
     * @param int $id
     * @return int
     * @version API-1
     */
    public function deleteUser($id) {
	return $this->getTable()->where("id",$id)->delete();
    }
    
    /**
     * Ban an user
     * @param type $id
     * @return type
     * @version API-1
     */
    public function banUser($id) {
	return $this->getTable()->where("id",$id)->update(array('banned' => true));
    }
    
    /**
     * Unban an user
     * @param type $id
     * @return type
     * @version API-1
     */
    public function unbanUser($id) {
	return $this->getTable()->where("id",$id)->update(array('banned' => FALSE));
    }
    
    /**
     * check if is user banned
     * @param type $uid
     * @return type
     * @version API-1
     */
    public function isBanned($uid){
	$usr = $this->getTable()->where("id",$uid)->fetch();
	return $usr->banned;
    }
    
    /**
     * Update users's lastactive
     * @param type $id
     * @return type
     * @version API-1
     */
    public function updateActivity($id) {
	return $this->getTable()->where("id",$id)->update(array (
	    "last_ip" => $_SERVER["REMOTE_ADDR"],
	    "last_activity" => new \Nette\Database\SqlLiteral("NOW()")
	    ));
    }
    
    /**
     * Vrátí výčet aktivních uživatelů za posledních 5 minut
     * @return type
     * @version API-1
     */
    public function getActiveUsers() {
	return $this->getTable()->where("last_activity BETWEEN DATE_SUB(now(), INTERVAL 5 MINUTE) AND NOW()");
    }
    
    /**
     * Is IP banned?
     * @param string $ip
     * @return boolean
     * @version API-3
     */
    public function isIpBanned($ip) {
	if($this->connection->table("ipban")->where("ip",$ip)->count() != 0) {
	    return true;
	}
	else 
	    return false;
    }
    
    /**
     * Ban a IP address
     * @param string $ip
     * @return \Nette\Database\Table\ActiveRow
     * @version API-3
     */
    public function banIp($ip) {
	return $this->connection->table("ipban")->insert($ip);
    }
    
    /**
     * Unban a IP address
     * @param string $ip
     * @return int
     * @version API-3
     */
    public function unbanIp($ip) {
	return $this->connection->table("ipban")->where("ip",$ip)->delete();
    }
    
    /**
     * Set a custom column in user repository
     * @param int $uid
     * @param string $column
     * @param mixed $content
     * @return int
     * @version API-4
     */
    public function setCustom($uid, $column, $content) {
	return $this->getTable()->get($uid)->update(array($column => $content));
    }
    
    /**
     * Make reset password request
     * @param string $mail
     * @return \Nesys\Ticket
     * @throws \Nette\Security\AuthenticationException
     * @version API-4
     */
    public function passwordResetRequest($mail) {
	if ($this->getTable()->where("mail",$mail)->count() != 0) {
	    $uid = $this->getTable()->where("mail",$mail)->fetch()->id;
	    $key = \uniqid();
	    $this->getSubTable("tickets")->insert(array("uid" => $uid, "ticket" => $key));
	    $ticket = new Ticket();
	    $ticket->key = $key;
	    $ticket->uid = $uid;
	    return $ticket;
	}
	else {
	    throw new \Nette\Security\AuthenticationException("Tento e-mail není zaregistrován.");
	}
    }
    
    /**
     * Reset password
     * @param \Nesys\Ticket $ticket
     * @return string
     * @throws \Nette\Security\AuthenticationException
     * @version API-4
     */
    public function resetPassword(\Nesys\Ticket $ticket) {
	$key = $this->getSubTable("tickets")->where("uid = ? AND ticket = ?",$ticket->uid,$ticket->key)->fetch()->ticket;
	//dump($key);
	//dump($ticket->key);
	//dump($ticket->uid);
	if ($key == $ticket->key && $key != null) {
	    $newpass = \uniqid();
	    $this->changePass($ticket->uid, $newpass);
	    $this->getSubTable("tickets")->where("uid",$ticket->uid)->delete();
	    return $newpass;
	}
	else 
	    throw new \Nette\Security\AuthenticationException("Neplatný ticket!");
    }
}

?>
