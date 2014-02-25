<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Controls;

/**
 * Description of Navbar
 *
 * @author JDC
 */
class Navbar extends \Nette\Application\UI\Control {

	protected $sideLeft;
	protected $sideRight;

	const SIDE_LEFT = "left",
			SIDE_RIGHT = "right";

	public function __construct(\Nette\ComponentModel\IContainer $parent = NULL, $name = NULL) {
		parent::__construct($parent, $name);
		$this->sideLeft = $this->sideRight = array();
	}

	public function render(){
		$this->template->setFile(__DIR__ . "/Navbar.latte");
		$this->template->sideLeft = $this->sideLeft;
		$this->template->sideRight = $this->sideRight;
		$this->template->render();
	}

	public function addControl($side, NavbarControl $control, $name) {

		$this->addComponent($control, $name);

		switch ($side) {
			case "left":
				return $this->sideLeft[] = $name;
			case "right":
				return $this->sideRight[] = $name;
			default:
				throw new \Nette\InvalidArgumentException("Side name '$side' is invalid");
		}
	}

}
