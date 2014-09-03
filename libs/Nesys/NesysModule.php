<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NesysModule
 *
 * @author JDC
 * @version API-2
 */
namespace Nesys;

/**
 * NesysModule parent
 * @version API-2
 */
abstract class NesysModule extends \Nette\Object {
  
    /** @var array */
    protected $moduleInfo;
    /** 
     * Služby registrované modulem
     * @var array */
    protected $services;
    /** @var \Nesys\NesysService */
    protected $requiredModules;
    /** @var \Nette\Database\Connection */
    protected $connection;
    /**
     * Jádro NESysu
     * @var \Nesys\NesysCore
     */
    protected $core;
    /**
     * Setup Nesys module
     * @version API-3
     * @since API-2
     */
    abstract function setup();
	  
    /**
     * 
     * @param \Nette\Database\Connection $db
     * @param \Nesys\NesysCore $core
     * @version API-2
     */
    function __construct(\Nette\Database\Connection $db, \Nesys\NesysCore &$core) {
	$this->connection = $db;
	$this->core = &$core;
	$this->requiredModules = array();
	$this->services = array();
	$this->setup();
    }
    /**
     * Gets a module information
     * @return array
     * @version API-2
     */
    public function getInfo() {
	return $this->moduleInfo;
    }
    
    /**
     * Gets version of module
     * @return string
     * @version API-2
     */
    public function getVersion() {
	return $this->moduleInfo["version"];
    }
    
    /**
     * Instaluje modul do systému
     * @return \Nette\Database\Table\ActiveRow
     * @version API-2
     */
    public function install() {
	if ($this->services != null) {
	    foreach ($this->services as $service) {
		$this->connection->table("services")->insert(array(
		    "name" => $service->getName(),
		    "type" => $service->getType(),
		    "args" => $service->getArgs()
		));
	    }
	}
	return $this->connection->table("modules")->insert(array(
	    "name" => $this->getReflection()->getName(),
	    "info" => \json_encode($this->moduleInfo)
	));	
    }
    
    /**
     * Odinstaluje modul ze systému
     * @return int
     * @version API-2
     */
    public function uninstall() {
	foreach ($this->services as $service) {
	    $this->connection->table("services")->where("name",$service->getName())->delete();
	}
	return $this->connection->table("modules")->where("name",$this->getReflection()->getName())->delete();
    }
    
    /**
     * Update a module
     * @return type
     * @version API-2
     */
    public function update() {
	//Update services and module
	if ($this->services != null) {
	    foreach ($this->services as $service) {
		if ($this->connection->table("services")->where("name",$service->getName())->count() != 0) {
		    $this->connection->table("services")->where("name",$service->getName())->update(array(
			"name" => $service->getName(),
			"type" => $service->getType(),
			"args" => $service->getArgs()
		    ));
		}
		else {
		     $this->connection->table("services")->insert(array(
			"name" => $service->getName(),
			"type" => $service->getType(),
			"args" => $service->getArgs()
		    ));
		}
	    }
	}
	return $this->connection->table("modules")->where("name",$this->getReflection()->getName())->update(array(
	    "name" => $this->getReflection()->getName(),
	    "info" => \json_encode($this->moduleInfo)
	));
    }

    /**
     * Check module requirements
     * @throws NesysModuleException
     * @version API-3
     * @since API-2
     */
    public function checkRequirements() {
	
	
	   
	if ($this->moduleInfo["nesys_api_min"] <= \Nesys\NesysCore::API && \Nesys\NesysCore::API <= $this->moduleInfo["nesys_api_max"]) {
	    //dump(version_compare(\Nesys\NesysCore::VERSION, $this->moduleInfo["nesys_ver_min"], ">="));
	    //dump(version_compare(\Nesys\NesysCore::VERSION, $this->moduleInfo["nesys_ver_max"], "<="));

	    //Check modules
	    foreach ($this->requiredModules as $module) {
		if ($this->connection->table("modules")->where("name",$module)->count() == 0)
		    throw new NesysModuleException("Vyžadovaný modul $module není nainstalován");
	    }
	    //Check services
	    /*foreach ($this->services as $service) {
		if (!\Nette\Environment::getContext()->hasService($service))
		    throw new NesysModuleException("Vyžadovaná služba $service neexistuje");
	    }*/
	    
	 }
	 else {
	     throw new NesysModuleException("Modul není touto verzí API NESysu podporován! Verze Nesysu ".\Nesys\NesysCore::VERSION." API-".\Nesys\NesysCore::API." Minimální požadovaná verze: API-".$this->moduleInfo["nesys_api_min"]." Kompatibilní až do: API-".$this->moduleInfo["nesys_api_max"]);
	 }
    }
   
    
}

?>
