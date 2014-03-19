<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Model;
/**
 * Description of LogRepository
 *
 * @author JDC
 */
class LogRepository extends Repository {
	
	/**
	 * Adds a log record of event
	 * @param string $media
	 * @param string $event
	 * @param string $who
	 * @param int $user_id
	 * @param mixed $resource
	 * @return \Nette\Database\Table\ActiveRow
	 */
	public function addRecord($media, $event, $who, $user_id = null, $resource = null) {
		return $this->getTable()->insert(array(
			"media" => $media,
			"event" => $event,
			"who" => $who,
			"user_id" => $user_id,
			"resource" => $resource
		));
	}
	
}
