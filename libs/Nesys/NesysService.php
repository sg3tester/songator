<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Service Entity
 *
 * @author JDC
 * @version API-2
 */
namespace Nesys;
class NesysService extends \Nette\Object {
    private $name;
    private $type;
    private $args;
    
    /**
     * Create a service entity
     * @param string $name
     * @param string $type
     * @param string $args
     * @version API-2
     */
    function __construct($name, $type, $args) {
	$this->name = $name;
	$this->type = $type;
	$this->args = $args;
    }
    
    /**
     * Gets service name
     * @return string
     * @version API-2
     */
    public function getName() {
	return $this->name;
    }
    
    /**
     * Gets service type
     * @return string
     * @version API-2
     */
    public function getType() {
	return $this->type;
    }
    
    /**
     * Gets a service arguments
     * @param bool $asarray
     * @return string or array 
     * @version API-2
     */
    public function getArgs($asarray = false) {
	if ($asarray)
	    return \explode(",", $this->args);
	else
	    return $this->args;
    }
}

?>
