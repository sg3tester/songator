<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
use Nette\Database\Context;
/**
 * Description of Settings
 *
 * @author JDC
 */
class Settings extends \Nette\Object {
	
	const TABLE_NAME = "settings";
	
	/** @var \Nette\Database\Context */
	protected $db;
	
	protected $fetched = array();
	protected $toUpdate = array();
	protected $toInsert = array();
	
	public function __construct(Context $db) {
		$this->db = $db;
	}
	
	public function get($key, $default = null) {
		$this->fetch();
		
		if(!key_exists($key, $this->fetched))
				return $default;
		return $this->fetched[$key];
	}
	
	public function set($key, $value) {
		$this->fetch();
		//dump($key.":".$value);
		if(key_exists($key, $this->fetched))
			$this->toUpdate[$key] = $value;
		else
			$this->toInsert[$key] = $value;
		
		$this->fetched[$key] = $value; //Refresh data
	}

	public function push() {
		$this->db->beginTransaction();
		
		//Insert
		foreach ($this->toInsert as $key => $value) {
			$this->getTable()->insert(array(
				"key" => $key,
				"value" => $value
			));
		}
		
		//Update
		foreach ($this->toUpdate as $key => $value) {
			$this->getTable()->where("key",$key)->update(array(
				"value" => $value
			));
		}
		
		$this->db->commit(); //PTT
		
		$this->fetched = $this->toInsert = $this->toUpdate = array(); //Clean
	}
	
	public function pull() {
		$this->fetched = $this->getTable()->fetchPairs("key", "value");
	}
	
	protected function getTable() {
		return $this->db->table(self::TABLE_NAME);
	}
	
	protected function fetch() {
		if (!count($this->fetched))
			$this->pull();
	}
}
