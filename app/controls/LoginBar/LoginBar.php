<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Controls;
/**
 * Login Bar
 *
 * @author JDC
 */
class LoginBar extends NavbarControl {

	public function __construct() {
		parent::__construct();
	}

	public function render() {
		$this->template->setFile(__DIR__ . "/LoginBar.latte");
		$this->template->wip = $this->presenter->wip;
		$this->template->render();
	}

	public function getInfo() {
		$info = new Utils\NavbarControlInfo;
		$info->name = "Uživatelský panel";
		$info->desc = "Uživatelský panel, Přihlášení/Odhlášení";
		return $info;
	}

	public function handleWipOn() {
		if ($this->presenter->checkPermissions("wip", "switch")) {
			$this->presenter->settings->set("songator_wip", true);
			$this->presenter->settings->push();
		}
		$this->redirect("this");
	}
	
	public function handleWipOff() {
		if ($this->presenter->checkPermissions("wip", "switch")) {
			$this->presenter->settings->set("songator_wip", false);
			$this->presenter->settings->push();
		}
		$this->redirect("this");
	}
}
