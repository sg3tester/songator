<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ban
 *
 * @author jdc
 */
class Ban extends \Nesys\Repository {
	
	protected function setup() {
		$this->tablename = "ipban";
	}
	
	public function add($ip) {
		return $this->getTable()->insert(array("ip" => $ip));
	}

	public function isBanned($ip) {
		if($this->getTable()->where("ip",$ip)->fetch())
			return TRUE;
		else
			return FALSE;
	}
//put your code here
}
