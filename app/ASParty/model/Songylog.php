<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Songylog
 *
 * @author jdc
 */
class Songylog extends Nesys\Repository {
	
	protected function setup() {
		$this->tablename = "likelog";
	}

	public function log($ip, $song) {
		$this->getTable()->insert(array("ip" => $ip, "songy_id" => $song));
	}
	
	public function spammerDetect($ip) {
		$count = count($this->getTable()->where("ip",$ip)->where("timestamp >= DATE_SUB(now(), INTERVAL 1 MINUTE)"));
		return $count >= 10 ? true : false;
	}
}
