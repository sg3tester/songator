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
		$this->addRole("revizor", "user");
		$this->addRole("asistent", "revizor");
		$this->addRole("manager", "asistent");
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
		
		$this->allow("revizor", "song", array("approve", "reject"));
		$this->allow("revizor", "wip", array("switch"));
		$this->allow("revizor", "privateMsg", "view");
		
		$this->allow("asistent", "admin", "view");
		$this->allow("asistent", "song", array("manage", "add", "edit", "remove"));
		$this->allow("asistent", "interpret", array("manage", "add", "edit", "remove", "assoc", "approve"));
		
		$this->allow("manager", "content", array("manage", "add", "edit", "remove"));
		$this->allow("manager", "songator", "switch");
		
		$this->allow("admin", self::ALL, self::ALL); //Admin can all
	}
	
	public function getRoles() {
		$roles = parent::getRoles();
		return array_combine($roles, $roles);
	}
	
}
