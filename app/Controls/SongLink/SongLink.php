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
class SongLink extends NavbarControl {
	
	public function render() {
		$this->template->setFile(__DIR__ . "/SongLink.latte");
		$this->template->render();
	}
	
}
