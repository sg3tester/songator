<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

use Nette\Database\Table\Selection;

/**
 * Description of FlagFilter
 *
 * @author JDC
 */
class FlagFilter extends \Nette\Object implements IFlagFilter {
	
	const OPERATOR_OR = " OR ",
			OPERATOR_AND = " AND ";
	
	/** @var \Nette\Database\Table\Selection */
	protected $model;

	/** @var array */
	protected $flags;
	
	/** The Operator */
	protected $operator = self::OPERATOR_OR;

	/**
	 * Filter IT!
	 * @param string $flags
	 */
	public function filter($flags) {
		
		//One and main logic!
		$columns = array();
		foreach (str_split($flags) as $char) {
			if (!array_key_exists($char, $this->flags))
				throw new \Nette\InvalidArgumentException("Unrecognized flag '$char'", 3315);
			$flag = $this->flags[$char];
			if (!is_array($flag)) {
				$arr = array();
				$arr["column"] = $flag;
				$arr["by"] = " = 1";
				$columns[] = $arr;
			}
			else
				$columns[] = $flag;
		}
		
		return $this->model->where($this->getQueryString($columns));
	}

	/**
	 * Map flags to a model (table columns)
	 * @param array $flags
	 */
	public function setFlags($flags) {
		$this->flags = $flags;
	}

	/**
	 * 
	 * @param \Nette\Database\Table\Selection $model
	 */
	public function setModel($model) {
		$this->model = $model;
	}
	
	public function setOperator($operator) {
		$this->operator = $operator;
	}

	protected function getQueryString(array $columns) {
		
		$string = "";
		$count = count($columns);
		$i = 0;
		foreach($columns as $column) {
			if (!key_exists("column", $column) || !key_exists("by", $column))
				throw new \Nette\InvalidStateException("Column array info must have 'column' and 'by'");
			
			$string .= $column["column"].$column["by"];
			if ($i < $count - 1)
				$string .= $this->operator;
			$i++;
		}
		
		return $string;
	}

}
