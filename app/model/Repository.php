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
		$this->parseTableName();
	}
	
	public function findAll() {
		return $this->getTable();
	}
	
	public function find($id) {
		
	}
	
	public function findBy(array $by) {
		
	}
	
	protected function getTable() {
		return $this->database->table($this->tableName);
	}
	
	protected function parseTableName() {
		$reflection = $this->getReflection();
		$prename = \lcfirst($reflection->getShortName());
		$this->tableName = str_replace("Repository", "", $prename);
	}
}
