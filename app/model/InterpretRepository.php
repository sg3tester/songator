<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Model;
use Nette\Database\Table\ActiveRow;

/**
 * Interpret manager
 *
 * @author JDC
 */
class InterpretRepository extends Repository {
	
	/**
	 * Gets interpret by name or by alias
	 * @param string $name
	 * @param string $follow Follow aliases?
	 * @return \Nette\Database\Table\ActiveRow|false|null
	 */
	public function getByName($name, $follow = true) {
		$r = $this->getTable()->where("nazev",$name)->fetch();
		
		if ($r && $follow) 
			return $this->follow($r);	
		return $r;
	}
	
	/**
	 * Bind interpret by name
	 * @param string $interpret
	 * @param bool $noaliases
	 * @return array
	 */
	public function bind($interpret, $noaliases = true) {
		$s = $this->findAll()->where("nazev LIKE ?",$interpret."%");
		
		if ($noaliases)
			$s->where("interpret_id", null);
		
		//Make array list
		$complete = array();
		foreach ($s as $row) {
			$complete[] = $row->nazev;
		}
		
		return $complete;
	}

	/**
	 * Follow alias to real interpret
	 * @param \Nette\Database\Table\ActiveRow $row
	 * @return \Nette\Database\Table\ActiveRow
	 */
	protected function follow(ActiveRow $row) {
		if ($row->interpret_id)
			return $this->follow($row->interpret);
		return $row;
	}
}
