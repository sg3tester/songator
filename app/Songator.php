<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

/**
 * Songator - http://asparty.jdc.2ne1.cz
 *
 * @author JDC
 */
class Songator {
	
	const NAME = "Songator",
			VERSION = "3.0-dev",
			VERSION_ID = 30000,
			BUILD_DATE = "";


	/**
	 * Static class - cannot be instantiated
	 * @throws \Nette\StaticClassException
	 */
	public function __construct() {
		throw new \Nette\StaticClassException;
	}
}
