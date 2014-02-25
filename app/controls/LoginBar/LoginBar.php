<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Controls;
/**
 * Description of SongLink
 *
 * @author JDC
 */
class LoginBar extends NavbarControl {

	public function __construct() {
		parent::__construct();
	}

	public function render() {
		$this->template->setFile(__DIR__ . "/LoginBar.latte");
		$this->template->render();
	}

	public function getInfo() {
		$info = new Utils\NavbarControlInfo;
		$info->name = "Uživatelský panel";
		$info->desc = "Uživatelský panel, Přihlášení/Odhlášení";
		return $info;
	}

}
