<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Controls;

/**
 * Description of YoutubePlayer
 *
 * @author JDC
 */
class DailymotionPlayer extends Player {

	public function render() {
		$this->template->setFile(__DIR__ . "/DailymotionPlayer.latte");
		$this->template->id = explode("_",$this->url->getRelativeUrl())[0];
		$this->template->url = $this->url->absoluteUrl;
		$this->template->render();
	}

}
