<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

/**
 * Flag filter adapter
 * @author JDC
 */
interface IFlagFilter {
	
	/**
	 * Sets a datasource to filtering
	 * @var mixed
	 */
	public function setModel($model);

	/**
	 * Map filter flags to datasource
	 * @var array
	 */
	public function setFlags($flags);
	
	/**
	 * @return mixed
	 */
	public function filter($flags);
	
}
