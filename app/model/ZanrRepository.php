<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Model;
/**
 * Description of ZanrRepository
 *
 * @author JDC
 */
class ZanrRepository extends Repository {
	
	public function getList() {
		return $this->findAll()->fetchPairs("id", "name");
	}
	
}
