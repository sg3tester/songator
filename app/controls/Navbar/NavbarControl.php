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
	
	abstract public function getInfo();

	public function setup($config) {
		if (is_string($config))
			$config = json_decode($config);
		$this->config = $config;
	}
	
}
