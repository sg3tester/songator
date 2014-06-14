<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Model;
use Nette\Database\IRow;
use Nette\Utils\Arrays;

/**
 * Description of Song
 *
 * @author JDC
 */
class SongRepository extends Repository {

	const STATUS_APPROVED = "approved",
			STATUS_REJECTED = "rejected",
			STATUS_WAITING = "waiting",
			TABLE_LIKES = "song_likes";

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

		//Check song duplicity
		if ($this->getTable()->where("interpret_name = ? AND name = ?", $interpret, $song["name"])->fetch())
			throw new \UnexpectedValueException("Duplicitní song. Nelze uložit");

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

	/**
	 * Approve song
	 * @param int $song
	 * @param int $revizor
	 * @param string $note
	 * @param array|null $additional
	 */
	public function approve($song, $revizor, $note = "", $additional = null) {

		$this->setStatus($song, self::STATUS_APPROVED, $revizor, $note, $additional);

	}

	public function reject($song, $revizor, $reason, $additional = null) {

		$this->setStatus($song, self::STATUS_REJECTED, $revizor, $reason, $additional);

	}
	
	/**
	 * 
	 * @param string $interpret
	 * @param string $song
	 * @return \Nette\Database\Table\Selection
	 */
	public function match($interpret, $song) {
		
		$matching = array();
		$matching["matching"]["interpret"] = $interpret;
		$matching["matching"]["song"] = $song;
		$matching["match"] = false;
		
		if (!$song)
			return $matching;
		
		$matches = $this->levenshtein($song, 10);
		
		if ($interpret)
			$matches->where ("interpret_name LIKE ?",$interpret."%");
		$result = array();
		
		
		
		foreach ($matches as $match) {
			$song = array();
			$song["id"] = $match->id;
			$song["interpret"] = $match->interpret_name;
			$song["name"] = $match->name;
			$song["distance"] = $match->distance;
			$result[] = $song;
		}
		if (count($result)) {
			$matching["match"] = true;
			if ($result[0]["distance"] == 0)
				$matching["matched"] = $result[0];
			$matching["similar"] = $result;
		}

		
		return $matching;
	}
	

	////////////////////////////////////////////////////////////////////////////

	/**
	 * Mysql levenshtein query
	 * @param string $keyword
	 * @return \Nette\Database\Table\Selection
	 */
	protected function levenshtein($keyword, $distance = 10) {
	return $this->getTable()->select("*,levenshtein(name, ?) AS distance", $keyword)
		->where("levenshtein(name, ?) < $distance",$keyword)
		->order("distance ASC");
    }
	
	private function setInterpret($songId, $interpret) {
		return $this->getTable()->get($songId)->update(array("interpret_id" => $interpret));
	}

	private function setStatus($song, $status, $revizor, $note, $additional) {
		//Mapping
		if ($additional)
			$data = $additional;
		else
			$data = array();

		//Check status validity
		$allowed = array ("approved","rejected","waiting");
		if (!in_array($status, $allowed))
			throw new \Nette\InvalidArgumentException(72, "Invalid status. '$status' is unknown");

		$data["revisor"] = $revizor;
		$data["note"] = $note;
		$data["status"] = $status; //This is important

		$this->getTable()->get($song)->update($data); //Update song
	}
	
	/**
	 * User likes a song
	 * @param int $song
	 * @param int $user
	 * @throws \Nette\IOException
	 * @return IRow|int|bool
	 */
	public function like($song, $user) {
		$table = $this->database->table(self::TABLE_LIKES);

		if($table->where("user_id", $user)->where("song_id", $song)->where("date < ?","24 hours")->fetch())
			throw new \Nette\IOException("This user liked it", 77);
		
		return $table->insert(array(
				'user_id' => $user,
				'song_id' => $song
			));
	}

}
