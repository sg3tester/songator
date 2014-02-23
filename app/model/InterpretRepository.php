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
	
	public function match($interpret) {
		$matches = $this->levenshtein($interpret, 10); //distance is 10
		
		$result = array();
		$result["matching"] = $interpret;
		if (count($matches) > 0) {
			$match = $matches->fetch();
			$result["match"] = true;
			$result["distance"] = $match->distance;
			$result["matched"] = $match->nazev;
			$alias = $this->follow($match);
			$result["alias"] = $alias->nazev != $match->nazev ? $alias->nazev : false;
			$result["other"] = $this->iterateMatches($matches);
		}
		else 
			$result["match"] = false;
		
		return $result;
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
	
	/**
	 * Mysql levenshtein query
	 * @param string $keyword
	 * @return \Nette\Database\Table\Selection
	 */
	protected function levenshtein($keyword, $distance) {
	return $this->getTable()->select("*,levenshtein(nazev,'$keyword') AS distance")
		->where("levenshtein(nazev, ?) < $distance",$keyword)
		->order("distance ASC");
    }
	
	private function iterateMatches($matches) {
		$iterator = 0;
		$result = array();
		foreach ($matches as $row) {
				if ($iterator > 0)
					$result[] = $row->nazev;
				if ($iterator == 10)
					break;
				$iterator++;
			}
		return $result;
	}

}
