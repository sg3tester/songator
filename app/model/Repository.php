<?php

namespace App\Model;

/**
 * Description of Repository
 *
 * @author JDC
 */
abstract class Repository extends \Nette\Object {

	/** @var \Nette\Database\Context */
	protected $database;
	protected $tableName;

	public function __construct(\Nette\Database\Context $db) {
		$this->database = $db;
		$this->tableName = $this->parseTableName();
	}

	/**
	 * Returns all records from table
	 * @return \Nette\Database\Table\Selection
	 */
	public function findAll() {
		return $this->getTable();
	}

	/**
	 * Fetch one record by id
	 * @param int $id
	 * @return \Nette\Database\Table\ActiveRow
	 */
	public function find($id) {
		return $this->getTable()->get($id);
	}

	/**
	 * Returns a records by specified arguments
	 * @param array $by
	 * @return \Nette\Database\Table\Selection
	 */
	public function findBy(array $by) {
		return $this->getTable()->where($by);
	}

	protected function getTable() {
		return $this->database->table($this->tableName);
	}

	protected function parseTableName() {
		$reflection = $this->getReflection();
		$prename = \lcfirst($reflection->getShortName());
		return str_replace("Repository", "", $prename);
	}
}
