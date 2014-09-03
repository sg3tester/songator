<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Nesys;
/**
 * Description of Songy
 *
 * @author JDC
 */
class Songy extends \Nesys\Repository {
    
    public function setup() {
	$this->tablename = "songy";
    }
    
    public function getSongs($status = null) {
	if ($status == null)
	    return $this->getTable();
	else
	    return $this->getTable()->where("status",$status);
    }
    
    public function addSong($data) {
	return $this->getTable()->insert($data);
    }
    
    public function getSong($id) {
	return $this->getTable()->get($id);
    }
    
    public function setStatus($id, $status, $revizor = null) {
	return $this->getTable()->get($id)->update(array ("status" => $status, "revidedby" => $revizor));
    }
    
    public function remove($id) {
	return $this->getTable()->get($id)->delete();
    }
    
    public function editSong($id, $data) {
	return $this->getTable()->get($id)->update($data);
    }
	
	public function like($id) {
		$this->getTable()->get($id)->update(array("likes" => new \Nette\Database\SqlLiteral("likes + 1")));
	}
    
    public function songExists($interpret,$song) {
	if ($this->getTable()->where("interpret = ? AND song = ?",$interpret,$song)->fetch() != null)
		return true;
	else
	    return false;
		    
    }
}

?>
