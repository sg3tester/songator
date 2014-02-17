<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Controls;

/**
 * Description of NavbarControl
 *
 * @author JDC
 */
abstract class NavbarControl extends \Nette\Application\UI\Control {
	
	/** @var array */
	protected $config;

	abstract public function render();
	
	public function setup($config) {
		$this->config = $config;
	}
	
}
