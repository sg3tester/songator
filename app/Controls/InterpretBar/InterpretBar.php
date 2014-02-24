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
class InterpretBar extends NavbarControl {

	public function __construct() {
		parent::__construct();
	}
	
	public function render() {
		$this->template->setFile(__DIR__ . "/InterpretBar.latte");
		if (isset($this->config->pages))
			$this->template->pages = $this->config->pages;
		$this->template->render();
	}

	public function getInfo() {
		$info = new Utils\NavbarControlInfo;
		$info->name = "Interpreti";
		$info->desc = "Správa interpretů";
		return $info;
	}

}
