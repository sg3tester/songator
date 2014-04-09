<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Model;

/**
 * Description of Permissions
 *
 * @author JDC
 */
class Permissions extends \Nette\Security\Permission {
	
	public function __construct() {
		
		//Roles
		$this->addRole("guest");
		$this->addRole("user", "guest");
		$this->addRole("asistent", "user");
		$this->addRole("dj", "asistent");
		$this->addRole("admin"); //Superuser
		
		//Admin areas
		$this->addResource("admin");
		$this->addResource("system");
		$this->addResource("content");
		$this->addResource("songator");
		
		//Front areas
		$this->addResource("song");
		$this->addResource("interpret");
		$this->addResource("wip");
		$this->addResource("ucp");
		$this->addResource("sign");
		$this->addResource("privateMsg");
		
		//Privileges		
		$this->deny(array("guest", "user"), "system"); //Security
		
		$this->allow("guest", "song", array("draft", "view", "play"));
		$this->allow("guest", "interpret", array("draft", "view"));
		
		$this->allow("user", "song", array("like"));
		$this->allow("user", "ucp", array("view", "save"));
		$this->allow("user", "privateMsg", "add");
		
		$this->allow("asistent", "admin", "view");
		$this->allow("asistent", "song", array("approve", "reject"));
		$this->allow("asistent", "wip", array("switch"));
		$this->allow("asistent", "privateMsg", "view");
		
		$this->allow("dj", "song", array("manage", "add", "edit", "remove"));
		$this->allow("dj", "interpret", array("manage", "add", "edit", "remove", "assoc", "approve"));
		$this->allow("dj", "content", array("manage", "add", "edit", "remove"));
		$this->allow("dj", "songator", "switch");
		
		$this->allow("admin", self::ALL, self::ALL); //Admin can all
	}
	
}
