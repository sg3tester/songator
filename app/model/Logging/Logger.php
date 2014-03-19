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
	
	public function log($media, $event, $resource = null, $who = null) {
		
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
		
		//Prepare resource
		if ($resource)
			$resource = \Nette\Utils\Json::encode($resource);
		
		//Add a record
		$this->storage->addRecord($media, $event, $who, $user_id, $resource);
	}
	
	public function systemLog($media, $event, $resource = null) {
		
		//Prepare resource
		if ($resource)
			$resource = \Nette\Utils\Json::encode($resource);
		
		//Add a record
		$this->storage->addRecord($media, $event, self::USR_SYSTEM, null, $resource);
	}
	
}
