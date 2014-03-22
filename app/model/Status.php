<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

/**
 * Songator status indicator
 *
 * @author JDC
 * @method string getMessage()
 */
final class Status extends Nette\Object {
	
	private $portalEnabled;
	
	private $message;
	
	private $addingEnabled;
	
	public function __construct($portalEnabled, $addingEnabled, $message = null) {
		$this->portalEnabled = $portalEnabled;
		$this->addingEnabled = $addingEnabled;
		$this->message = null;
	}
	
	/**
	 * Is portal enabled?
	 * @return boolean
	 */
	public function isPortalEnabled() {
		return $this->portalEnabled;
	}
	
	/**
	 * Is song adding enabled?
	 * @return boolean
	 */
	public function isAddingEnabled() {
		return $this->addingEnabled;
	}
}
