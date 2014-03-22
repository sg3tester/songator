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
 * 
 * @method setMask($mask)
 * @method string getMask()
 * @method setMethod($method)
 * @method string getMethod()
 * @method setPlaceholder($phldr)
 * @method string getPlaceholder()
 */
class Searcher extends Nette\Object {
	
	/** @var \Nette\Database\Table\Selection */
	private $model;
	private $columns;
	private $mask;
	private $method;
	private $placeholder;
	
	const LIKE = "LIKE",
			REGEXP = "REGEXP";
	
	public function __construct() {
		$this->mask = "?%";
		$this->placeholder = "?";
		$this->method = self::LIKE;
		$this->columns = array();
	}
	
	public function setModel(Selection $model) {
		$this->model = $model;
	}
	
	public function setColumns(array $columns) {
		$this->columns = $columns;
	}

	public function search($q) {
		$query = "";
		$count = count($this->columns);
		$i = 0;
		$phldrs = array();
		foreach ($this->columns as $column) {
			$query .= new \Nette\Database\SqlLiteral($column." ".$this->method." ?");
			$phldrs[] = str_replace($this->placeholder, $q, $this->mask);
			if ($i < $count - 1)
				$query .= " OR ";
			$i++;
		}
		return $this->model->where($query, $phldrs);
	}
	
}
