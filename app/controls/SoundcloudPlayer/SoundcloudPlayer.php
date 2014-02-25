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
class SoundcloudPlayer extends Player {

	public function render() {
		$this->template->setFile(__DIR__ . "/SoundcloudPlayer.latte");
		$rsrc = file_get_contents("http://soundcloud.com/oembed?format=json&url=".$this->url->getAbsoluteUrl()."&iframe=true");
		$json = json_decode($rsrc);
		$this->template->iframe = $json->html;
		$this->template->url = $this->url;
		$this->template->render();
	}

}
