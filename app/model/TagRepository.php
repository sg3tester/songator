<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Model;
/**
 * Description of TagRepository
 *
 * @author JDC
 */
class TagRepository extends Repository {

	public function getCloud() {
		return $this->getTable()->select("name, COUNT(:blog_tag.tag_id) AS score")->group(":blog_tag.tag_id")->fetchPairs("name","score");
	}
}
