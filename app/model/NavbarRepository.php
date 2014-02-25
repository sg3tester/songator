<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Model;
/**
 *
 * @author JDC
 */
class NavbarRepository extends Repository {

	/**
	 * Gets sides included bars as associated array
	 * @return type
	 */
	public function getAssocSides() {
		$navs = array();
		foreach ($this->findAll() as $bar) {
			$navs[$bar->dock][] = $bar;
		}
		return $navs;
	}

}
