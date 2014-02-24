<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Model;
/**
 * Description of ContentRepository
 *
 * @author JDC
 */
class ContentRepository extends Repository {
	
	/**
	 * Gets a page
	 * @param string $name
	 * @param bool $xray
	 * @return \Nette\Database\Table\ActiveRow
	 */
	public function getPage($name, $xray = false) {
		$page = $this->getTable()->where("name",$name);
		if (!$xray)
			$page->where ("hidden", false);
		return $page->fetch();
	}
	
}
