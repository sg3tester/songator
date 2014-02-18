<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Controls;
/**
 *
 * @author JDC
 */
interface ILoginBarFactory {
	
	/**
	 * @return \App\Controls\LoginBar
	 */
	public function create();
}
