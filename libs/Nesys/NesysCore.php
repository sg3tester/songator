<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Nesys;
/**
 * Nesys CMS Core
 * @author JDC <jdc@2ne1.cz>
 * @version API-5
 * @since API-1
 */
class NesysCore extends \Nette\Object {
    private $appName;
    private $appVersion;
    private $appDesc;
    private $appAuthors;
    private $appEmail;
    private $modules;
    private $devel;
    private $devel_msg;
    /** @var array **/
    private $globvars;
    
    const NAME = "Nesys";
    const VERSION = "1.8.1";
    const CODENAME = "Escarlate";
    /**
     * Back compatibility
     * @deprecated
     */
    const NICKNAME = self::CODENAME;
    const BUILDDATE = "2013-08-18";
    /** @version API-5 */
    const RELEASEDATE = null;
    const API = 5;
    
    //Logger
    const LOG_ACCESS = "nesys_access";
    const LOG_USER = "nesys_user";
    const LOG_ACTION = "nesys_action";
    const LOG_ERROR = "nesys_error";
    const LOG_ADMIN = "nesys_admin";
    
    /**
     * Service IP adresses for maintenance
     * @var array
     * @version API-5
     */
    public static $ServiceIPs = array();
    
    protected $connection;
    /**
     *
     * @var \Nette\Database\Connection
     */
    
    function __construct(\Nette\DI\Container $container) {
	
	//Is running in develop mode?
	if (\file_exists(".devel")) {
	    $this->devel = true; //Develop mode activated
	    $this->devel_msg = \file_get_contents(".devel");
	    if (empty($this->devel_msg))
		$this->devel_msg = "Development version";
	}
	else 
	    $this->devel = false; //Inactive develop mode
	$this->connection = $container->nette->database->default;
	$sluzby = $this->connection->table("services");
	foreach ($sluzby as $sluzba) {
	    //dump($sluzba->type);
	    if (!$container->hasService($sluzba->name)) {
		$container->addService($sluzba->name, function($container) use ($sluzba){
		    $ref = new \Nette\Reflection\ClassType($sluzba->type);
		    $args = explode(",",$sluzba->args);
		    $params = array();
		    foreach ($args as $arg) {
			$params[] = $container->getService($arg);
		    }
		    //dump($args);
		    return $ref->newInstanceArgs($params);
		});
	    }
	}
	
    }

    /**
     * Konfigurátor jádra. 
     * VAROVÁNÍ: Nepoužívat jinde kromě Nesys\NesysConf!
     * @param type $conf
     * @version API-2
     * @since API-1
     * @throws \Nette\FatalErrorException
     */
    public function conf($conf) {
	if (!isset($conf) || $conf == null || $conf == '') {
	    throw new \Nette\FatalErrorException("Chybí konfigurátor NESysu! Zkontrolujte konfigurační soubor (config.neon)");
	}
	//Check modules validity
	//dump($conf["modules"]);
	if ($conf["modules"] != null) {
	    foreach ($conf["modules"] as $module) {
		if (!\class_exists($module)) {
		    throw new \Nette\Application\ApplicationException("Modul $module nebyl nalezen!");
		}
		if(!\in_array("Nesys\NesysModule", \class_parents($module))){
		    throw new \Nette\Application\ApplicationException("Modul $module není potomkem třídy Nesys\Module");
		}
	    }
	}
	$this->appName = $conf["appName"];
	$this->appDesc = $conf["appDesc"];
	$this->appVersion = $conf["appVersion"];
	$this->appAuthors = $conf["appAuthors"];
	$this->appEmail = $conf["appEmail"];
	$this->modules = $conf["modules"];
	
	//Load service IPs
	foreach ($conf["serviceIPs"] as $ip) {
	    self::$ServiceIPs[] = $ip;
	}
    }
  
    /**
     * Gets a specific table by $table
     * @param string $table
     * @version API-1
     * @return \Nette\Database\Table\Selection
     */
    protected function getOtherTable($table) {
	 return $this->connection->table($table);
    }

     /**
     * Gets a list of modules
      * @version API-2
     * @return array
     */
    public function getModuleList() {
	return $this->modules;
    }
    
    /**
     * Instaluje daný modul do systému
     * @param string $modulename
     * @version API-2
     */
    public function installModule($modulename) {
	$module = new $modulename($this->connection,$this);
	if(!$this->isModuleInstalled($modulename))
	{
	    $module->checkRequirements();
	    $module->install();
	}
	else
	    throw new \Nette\FatalErrorException("Modul $modulename je již nainstalován!");
    }
    
    /**
     * Odinstaluje daný modul ze systému
     * @param string $modulename
     * @version API-2
     */
    public function uninstallModule($modulename) {
	$module = new $modulename($this->connection,$this);
	$module->uninstall();
    }
    
    /**
     * Update a module
     * @param string $modulename
     * @version API-2
     */
    public function updateModule($modulename) {
	$module = new $modulename($this->connection,$this);
	$module->checkRequirements();
	$module->update();
    }


    /**
     * Add menuitem to Tools Menu container
     * @param \Nesys\ToolMenuItem $menuitem Specific menu item
     * @version API-2
     * @return \Nette\Database\Table\ActiveRow
     */
    public function addToToolMenu(\Nesys\ToolMenuItem $menuitem) {
	return $this->connection->table("toolsmenu")->insert($menuitem->toArray());
    }
    
    /**
     * Update tool menu item in Tool Menu container
     * @param string $menu
     * @param string $name
     * @param \Nesys\ToolMenuItem $menuitem
     * @version API-2
     * @return int
     */
    public function updateToolMenuItem($menu, $name, \Nesys\ToolMenuItem $menuitem) {
	return $this->getOtherTable("toolsmenu")->where("menu = ? && name = ?",$menu,$name)->update($menuitem->toArray());
    }
    
    /**
     * 
     * @param string $menu
     * @param string $name
     * @version API-2
     * @return \Nesys\ToolMenuItem
     */
    public function getToolMenuItem($menu,$name) {
	$item = $this->getOtherTable("toolsmenu")->where("menu = ? && name = ?",$menu,$name)->fetch();
	return new \Nesys\ToolMenuItem($item->menu, $item->name, $item->target, $item->caption, $item->perms, $item->additional, $item->level, $item->id);
    }

    /**
     * Removes menuitem from Tools Menu container
     * @param string $menu Specific menu
     * @param string $target Specific target
     * @version API-2
     * @return int
     */
    public function removeFromToolMenu($menu,$name) {
	return $this->connection->table("toolsmenu")->where("menu = ? AND name = ?",$menu,$name)->delete();
    }
    
    /**
     * 
     * @param type $menu
     * @version API-2
     * @return \Nesys\ToolMenuItem[]
     */
    public function getToolMenu($menu) {
	$flush = $this->connection->table("toolsmenu")->where("menu",$menu)->order("level DESC");
	$toolMenu = array();
	foreach ($flush as $item) {
	    $toolMenu[] = new \Nesys\ToolMenuItem($item->menu, $item->name, $item->target, $item->caption, $item->perms, $item->additional, $item->level, $item->id);
	}
	return $toolMenu;
    }
    
    /**
     * Gets installed modules in system
     * @version API-2
     * @return \Nette\Database\Table\Selection
     */
    public function getInstalledModules() {
	return $this->connection->table("modules");
    }
    
    /**
     * Check is module installed in system
     * @param string $modulename
     * @version API-2
     * @return boolean
     */
    public function isModuleInstalled($modulename) {
	if ($this->connection->table("modules")->where("name",$modulename)->count() == 0)
	    return false;
	else
	    return true;
    }

     /**
     * Gets module
     * @param string $modulename
     * @version API-2
     * @return \Nesys\NesysModule
     */
    public function getModule($modulename) {
	return new $modulename($this->connection,$this);
    }
    
    /**
     * 
     * @param string $modulename
     * @version API-2
     * @todo Možná se doplní, nebo označí jako deprecated či úplně odstraní
     */
    public function checkModuleRequirements($modulename) {
	
    }
    
    /**
     * Create or update option in system
     * @param string $option
     * @version API-1
     * @param string $value
     * @return \Nette\Database\Table\ActiveRow|int
     */
    public function setOption($option,$value) {
	if($this->connection->table("nesys")->where("option",$option)->fetch() == null)
	    return $this->connection->table("nesys")->insert(array("option" => $option, "value" => $value));
	else
	    return $this->connection->table("nesys")->where("option",$option)->update(array("value" => $value));
    }
    
    /**
     * Gets a system option
     * @param string $option
     * @version API-1
     * @return string Option value
     */
    public function getOption($option) {
	return $this->connection->table("nesys")->where("option",$option)->fetch()->value;
    }
    
    /**
     * Clear and removes a system option
     * @param string $option
     * @version API-1
     * @return int
     */
    public function clearOption($option) {
	return $this->connection->table("nesys")->where("option",$option)->delete();
    }
    
    /**
     * Sets global variable in system
     * @param string $varname
     * @param mixed $value
     * @version API-1
     */
    public function setVar($varname, $value) {
	$this->globvars[$varname] = $value;
    }
    
    /**
     * Gets global variable in system
     * @param type $varname
     * @version API-1
     * @return mixed
     */
    public function getVar($varname) {
	return $this->globvars[$varname];
    }
    
    /**
     * Clear global variable in system
     * @param string $varname
     * @version API-1
     * @todo NUTNO DODĚLAT!!!
     */
    public function clearVar($varname) {
	unset($this->globvars[$varname]);
    }
    
    /**
     * Nesys logger
     * @param string $logfile
     * @param string $message
     * @return boolean|int
     * @version API-3
     */
    public function log($logfile, $message) {
	return \file_put_contents("log/".$logfile."_".\date("Y-m-d", \time()).".log", "[".  \date("Y-m-d H:i:s", \time())."] ".$message."\n", \FILE_APPEND);
	//dump(\file_put_contents("log/".$logfile.".txt", "[".  \date("Y-M-D H:i:s", \time())."] ".$message));
    }
    
    /**
     * Is running in development mode?
     * @return boolean
     * @version API-5
     */
    public function isDevelop() {
	return $this->devel;
    }
    
    /**
     * Gets a development message (returns NULL if is develop mode inactive)
     * @return string
     * @version API-5
     */
    public function getDevelopMsg() {
	return $this->devel_msg;
    }
    
    /**
     * Initalalize Nesys CMS framework
     * @param \Nette\Config\Configurator $configurator
     * @return type
     * @version API-5
     */
    public static function init($configurator) {
	
	//Load Nesys CMS Framework
	$configurator->onCompile[] = function ($configurator, $compiler) {
	    $compiler->addExtension('nesys', new \Nesys\NesysConf);
	};
	
	return $configurator;
    }
    
    /**
     * Is Debug mode activated?
     * @return boolean
     * @version API-5
     */
    public static function isDebugMode() {
	if (\file_exists(".devel") && !\file_exists(".nodebug"))
	    return true;
	else
	    return false;
    }
}

?>
