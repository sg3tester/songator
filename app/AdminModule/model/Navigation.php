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
			),
			"interpret" => array(
				"text" => "Interpreti",
				"icon" => "fa fa-star-o",
				"menu" => $this->buildInterpretMenu()
			),
			"cms" => array(
				"text" => "CMS",
				"icon" => "fa fa-file",
				"menu" => $this->buildCmsMenu()
			),
			"system" => array(
				"text" => "Systém",
				"icon" => "fa fa-cogs",
				"menu" => $this->buildSystemMenu()
			),
			"log" => array(
				"text" => "Logy",
				"icon" => "fa fa-tasks"
			),
			"about" => array(
				"text" => "O Songatoru",
				"icon" => "fa fa-info-circle"
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
			),
			"genre" => array(
				"text" => "Žánry"
			)
		);
	}

	public function buildInterpretMenu() {
		return array(
			"editor" => array(
				"text" => "Přidat interpreta"
			),
			"list" => array(
				"text" => "Seznam interpretů",
			),
			"assoc" => array(
				"text" => "Asociace"
			)
		);
	}

	public function buildCmsMenu() {
		return array(
			"editor" => array(
				"text" => "Vytvořit stránku"
			),
			"list" => array(
				"text" => "Seznam stránek",
			)
		);
	}

	public function buildSystemMenu() {
		return array(
			"default" => array(
				"text" => "Nastavení"
			),
			"expert" => array(
				"text" => "Expertní nastavení",
			),
		);
	}

} 