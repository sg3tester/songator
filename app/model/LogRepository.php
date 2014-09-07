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
	 * Add a log to repository
	 * @param string $media
	 * @param string $event
	 * @param string $message
	 * @param string $who
	 * @param int $user_id
	 * @return \Nette\Database\Table\ActiveRow
	 */
	public function addRecord($media, $event, $message ,$who, $user_id = null) {
		return $this->getTable()->insert(array(
			"media" => $media,
			"event" => $event,
			"who" => $who,
			"user_id" => $user_id,
			"message" => $message
		));
	}
	
}
