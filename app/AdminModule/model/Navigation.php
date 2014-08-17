<?php
/**
 * Created by PhpStorm.
 * User: JDC
 * Date: 26.7.2014
 * Time: 18:22
 */

class Navigation extends \Nette\Object {

	/** @var \Nette\DI\Container */
	private $di;

	public function __construct(\Nette\DI\Container $di) {
		$this->di = $di;
	}

	public function buildNavigation() {
		return array(
			"dashboard" => array(
				"text" => "Dashboard",
				"icon" => "fa fa-dashboard"
			),
			"song" => array(
				"text" => "Songy",
				"icon" => "fa fa-music",
				"menu" => $this->buildSongMenu()
			)
		);
	}

	public function buildSongMenu() {
		return array(
			"add" => array(
				"text" => "Přidat song"
			),
			"list" => array(
				"text" => "Seznam songů",
				/*"badge" => array(
					"text" => 6,
					"color" => "yellow"
				)*/
			)
		);
	}

} 