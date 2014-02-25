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
class YoutubePlayer extends Player {

	public function render() {
		$this->template->setFile(__DIR__ . "/YoutubePlayer.latte");
		$this->template->id = $this->url->getQueryParameter("v");
		$this->template->url = $this->url->absoluteUrl;
		$this->template->render();
	}

}
