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
class NoPlayer extends Player {

	public function render() {
		$this->template->setFile(__DIR__ . "/NoPlayer.latte");
		$this->template->url = $this->url->absoluteUrl;
		$this->template->service = $this->url->getHost();
		$this->template->render();
	}

}
