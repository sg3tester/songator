<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Model;
use Nette\Utils\Arrays;

/**
 * Description of Song
 *
 * @author JDC
 */
class SongRepository extends Repository {
	
	/** @var \App\Model\InterpretRepository */
	protected $interpreti;

	public function __construct(\Nette\Database\Context $db, InterpretRepository $interpreti) {
		parent::__construct($db);
		$this->interpreti = $interpreti;
	}
	
	/**
	 * Adds a song to playlist
	 * @param array $song
	 * @return \Nette\Database\Table\ActiveRow
	 */
	public function add(array $song) {
		$interpret = isset($song["interpret_name"]) ? $song["interpret_name"] : null;
		
		//Assign interpret (if registered)
		$ri = $this->interpreti->getByName($interpret);
		if($ri)
			$song["interpret_id"] = $ri->id;
		
		return $this->getTable()->insert($song);
	}
	
	/**
	 * 
	 * @param int $songId
	 * @param string|int $interpret name or ID
	 * @return \Nette\Database\Table\ActiveRow|false
	 */
	public function assignInterpret($songId, $interpret) {
		
		if (is_string($interpret)) {
			$ri = $this->interpreti->getByName($interpret);
			if ($ri)
				return $this->setInterpret ($songId, $ri->id);
			return false;
		}
		elseif (is_integer($interpret)) 
			return $this->setInterpret($songId, $interpret);
	
		throw new \Nette\InvalidArgumentException(603, "Interpret must be name (string) or ID (integer)");
	}
	
	/**
	 * Gets songs by status
	 * (allowed: approved, waiting, rejected)
	 * @param string $status
	 * @return \Nette\Database\Table\Selection
	 */
	public function findByStatus($status) {
		$allowed = array("approved","waiting","rejected");
		if ($status && in_array($status, $allowed)) 
			return $this->findBy(array("status" => $status));
		return $status;
	}
	
	/**
	 * Returns count statistics of playlist
	 * @return array
	 */
	public function getSummary() {
		$summary = array("all" => 0, "approved" => 0, "waiting" => 0, "rejected" => 0,); //Inital
		$summary = Arrays::mergeTree($this->getTable()->select("status, COUNT(status) AS score")->group("status")->fetchPairs("status", "score"), $summary);
		$summary["all"] = $this->findAll()->count(); //All
		return $summary;
	}

	////////////////////////////////////////////////////////////////////////////
	
	private function setInterpret($songId, $interpret) {
		return $this->getTable()->get($songId)->update(array("interpret_id" => $interpret));
	}
	
}
