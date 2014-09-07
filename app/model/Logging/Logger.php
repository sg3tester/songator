<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Model\Logging;

/**
 * Description of Logger
 *
 * @author JDC
 */
class Logger extends \Nette\Object {
	
	const USR_ANONYMOUS = "GUEST",
			USR_SYSTEM = "SYSTEM";
	
	/** @var \App\Model\LogRepository **/
	protected $storage;
	
	/** @var \Nette\Security\User **/
	protected $user;
	
	public function __construct(\App\Model\LogRepository $storage, \Nette\Security\User $user) {
		$this->storage = $storage;
		$this->user = $user;
	}
	
	public function log($media, $event, $message, $who = null) {
		
		//Prepare identity
		$user_id = null;
		if ($this->user->isLoggedIn()) {
			$identity = $this->user->getIdentity();
			if (!$who)
				$who = $identity->username;
			$user_id = $identity->getId();
		}
		elseif (!$who) {
			$who = self::USR_ANONYMOUS;
		}
		
		//Prepare message
		$message = str_replace('%user%', $who, $message);
		
		//Add a record
		$this->storage->addRecord($media, $event, $message, $who, $user_id);
	}
	
	public function systemLog($media, $event, $message) {
		
		//Add a record
		$this->storage->addRecord($media, $event, $message, self::USR_SYSTEM);
	}
	
}
