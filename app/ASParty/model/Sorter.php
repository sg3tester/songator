<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Nesys;
/**
 * Description of Sorter
 *
 * @author JDC
 */
class Sorter extends \Nette\Object{
    
    private $heads;
    private $sortby;
    private $type;
    
    public function addHeads($heads) {
	$this->heads = $heads;
    }
    
    public function sort($orderby) {
	$s = \explode(" ", $orderby);
	$this->sortby = $s[0];
	$this->type = $s[1];
    }
    
    public function flush() {
	$flush = array();
	foreach ($this->heads as $head => $caption) {
	    $kontak = new \stdClass();
	    $kontak->matched = false;
	    $kontak->head = $head;
	    $kontak->caption = $caption;
	    $kontak->sortby = $this->sortby;
	    $kontak->type = $this->type;
	    if ($this->sortby == $head)
		$kontak->matched = true;
	    
	    $flush[] = $kontak;
	}
	//dump($flush);
	return $flush;
    }
}

