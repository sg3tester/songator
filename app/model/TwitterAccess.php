<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

/**
 * Description of TwitterAccess
 *
 * @author JDC
 */
class TwitterAccess extends \Nette\Object {
	
	/** @var \TwitterOAuth */
	protected $oauth;
	
	protected $isTwitterUser = false;


	public function __construct(array $twitter, Nette\Security\User $user) {
		$oauth_token = $oauth_token_secret = null;
		if ($user->isLoggedIn() && isset($user->getIdentity()->twitter)) {
			$oauth_token = $user->getIdentity()->twitter["oauth_token"];
			$oauth_token_secret = $user->getIdentity()->twitter["oauth_token_secret"];
		}
		$this->oauth = new TwitterOAuth($twitter["key"], $twitter["secret"], $oauth_token, $oauth_token_secret);
	}
	
	/**
	 * Is user logged with Twitter?
	 * @return bool
	 */
	public function isTwitterUser() {
		return $this->isTwitterUser;
	}
	
	/**
	 * 
	 * @return \stdClass
	 */
	public function verifyCredentials() {
		return $this->get("account/verify_credentials");
	}
	
	protected function get($url, array $params = null) {
		$result = $this->oauth->get($url, $params);
		if (isset($result->errors)) {
			foreach ($result->errors as $error) {
				throw new TwitterException($error->message, $error->code);
			}
		}
		return $result;
	}
}

class TwitterException extends \Nette\IOException {}