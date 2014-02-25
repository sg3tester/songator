<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Controls;
use Nette\Application\UI\Control;


/**
 * Description of Player
 *
 * @author JDC
 */
abstract class Player extends Control {

	/** @var \Nette\Http\Url */
	protected $url;

	public function __construct(\Nette\Http\Url $url) {
		parent::__construct();
		$this->url = $url;
	}

	abstract function render();

}
