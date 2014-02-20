<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Model;
use Nette\Database\Table\ActiveRow;

/**
 * Description of InterpretRepository
 *
 * @author JDC
 */
class InterpretRepository extends Repository {
	
	public function getByName($name, $follow = true) {
		$r = $this->getTable()->where("nazev",$name)->fetch();
		
		if ($r && $follow) 
			return $this->follow($r);	
		return $r;
	}
	
	protected function follow(ActiveRow $row) {
		if ($row->interpret_id)
			return $this->follow($row->interpret);
		return $row;
	}
	
}
