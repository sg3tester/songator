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
	 * Match interpret by name
	 * @param string $interpret
	 * @param int $distance Distance ceiling
	 * @param int $limit Iteration limit
	 * @return array
	 */
	public function match($interpret, $distance = 10, $limit = 10) {
		$matches = $this->levenshtein($interpret, $distance); //distance is 10

		$result = array();
		$result["matching"] = $interpret;
		if (count($matches) > 0) {
			$match = $matches->fetch();
			$result["match"] = true;
			$result["distance"] = $match->distance;
			$result["matched"] = $match->nazev;
			$alias = $this->follow($match);
			$result["alias"] = $alias->nazev != $match->nazev ? $alias->nazev : false;
			$result["other"] = $this->iterateMatches($matches, $limit);
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
	return $this->getTable()->select("*,levenshtein(nazev, ?) AS distance", $keyword)
		->where("levenshtein(nazev, ?) < $distance",$keyword)
		->order("distance ASC");
    }

	private function iterateMatches($matches, $max) {
		$iterator = 0;
		$result = array();
		foreach ($matches as $row) {
				if ($iterator > 0) {
					$m["interpret"] = $row->nazev;
					$m["distance"] = $row->distance;
					$result[] = $m;
				}
				if ($iterator == $max)
					break;
				$iterator++;
			}
		return $result;
	}

}
