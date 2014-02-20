<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Model;
/**
 * Genres
 *
 * @author JDC
 */
class ZanrRepository extends Repository {
	
	/**
	 * Get a genre list
	 * @return array
	 */
	public function getList() {
		return $this->findAll()->fetchPairs("id", "name");
	}
	
}
