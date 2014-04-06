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
class BlogBar extends NavbarControl {

	public function render() {
		$this->template->setFile(__DIR__ . "/BlogBar.latte");
		$this->template->render();
	}

	public function getInfo() {
		$info = new Utils\NavbarControlInfo;
		$info->name = "Blog";
		$info->desc = "DJs blog";
		return $info;
	}

}
