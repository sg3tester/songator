<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */

namespace App\Model;

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
	
	public function add($song) {
		$interpret = $song["interpret"];
		
		
	}
	
	public function assignInterpret($song, $interpret) {
		
	}
	
	
}
