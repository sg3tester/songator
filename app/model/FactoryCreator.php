<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

/**
 * Description of FactoryCreator
 *
 * @author JDC
 */
class FactoryCreator {

	/** @var \Nette\DI\Container */
	protected $di;

	public function __construct(\Nette\DI\Container $di) {
		$this->di = $di;
	}

	public function create($factory) {
		$factory = $this->di->getByType($factory);
		return $factory->create();
	}

}
