<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Nesys;
/**
 * Description of ToolMenuItem
 *
 * @author JDC
 * @version API-2
 */
class ToolMenuItem extends \Nette\Object {
    public $id;
    public $menu;
    public $target;
    public $caption;
    public $permsResource;
    public $permsCapability;
    public $additional;
    public $restricted;
    public $name;
    public $level;
	    
    /**
     * Create a toolmenuitem
     * @param string $menu
     * @param string $name
     * @param string $target
     * @param string $caption
     * @param string $perms
     * @param string|array $additional
     * @param string $id
     * @version API-2
     */
    function __construct($menu,$name,$target,$caption,$perms = "everyone",$additional = null, $level = 1, $id = 0) {
	$this->menu = $menu;
	$this->target = $target;
	$this->caption = $caption;
	$this->id = $id;
	$this->level = $level;
	$this->name = $name;
	if ($additional != null && !\is_array($additional))
	    $this->additional = \json_decode($additional);
	if (\is_array($additional)) {
	    $this->additional = $additional;
	    //dump($this->additional);
	}
	    
	if ($perms != "everyone") {
	    $perm = \explode(":", $perms);
	    $this->permsResource = $perm[0];
	    $this->permsCapability = $perm[1];
	    $this->restricted = true;
	}
	else 
	    $this->restricted = false;
    }
    
    /**
     * Gets information about item as array
     * @return array
     * @version API-2
     */
    public function toArray() {
	$item = array(
	    "menu" => $this->menu,
	    "name" => $this->name,
	    "target" => $this->target,
	    "caption" => $this->caption,
	    "level" => $this->level
	);
	if ($this->additional != null)
	    $item["additional"] = json_encode($this->additional,\JSON_UNESCAPED_SLASHES);
	if ($this->restricted)
	    $item["perms"] = $this->permsResource.":".$this->permsCapability;
	else
	    $item["perms"] = "everyone";
	if ($this->id != 0) 
	    $item["id"] = $this->id;
	return $item;
    }

    
}

?>
