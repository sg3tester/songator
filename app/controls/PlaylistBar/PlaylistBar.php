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
class PlaylistBar extends NavbarControl {

	/** @var \App\Model\Song */
	protected $songList;

	public function __construct(\App\Model\SongRepository $songList) {
		parent::__construct();
		$this->songList = $songList;
	}

	public function render() {
		$this->template->setFile(__DIR__ . "/PlaylistBar.latte");
		$this->template->waiting = $this->songList->findAll()->where("status", "waiting")->count();
		if (isset($this->config->pages))
			$this->template->pages = $this->config->pages;
		$this->template->render();
	}

	public function getInfo() {
		$info = new Utils\NavbarControlInfo;
		$info->name = "Playlist";
		$info->desc = "Správa a organizace playlistu";
		return $info;
	}

}
