<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

use \Nette\Database\Table\Selection;

/**
 * Searching powered by LIKE function
 *
 * @author JDC
 */
class Searcher extends Nette\Object {
	
	/** @var \Nette\Database\Table\Selection */
	private $model;
	
	private $columns;

	public function setModel(Selection $model) {
		$this->model = $model;
	}
	
	public function setColumns($columns) {
		$this->columns = $columns;
	}

	public function search($q) {
		$query = "";
		$count = count($this->columns);
		$i = 0;
		$phldrs = array();
		foreach ($this->columns as $column) {
			$query .= new \Nette\Database\SqlLiteral($column." LIKE ?");
			$phldrs[] = $q."%";
			if ($i < $count - 1)
				$query .= " OR ";
			$i++;
		}
		return $this->model->where($query, $phldrs);
	}
	
}
