<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Nesys;
/**
 * Description of NesysPresenter
 *
 * @author JDC
 * @version API-5
 */
abstract class NesysPresenter extends \Nette\Application\UI\Presenter {
    
    /**
     *
     * @var \Nesys\NesysCore
     * @version API-5
     */
    protected $core;
    
    /** 
     * @var array
     * @version API-5
     */
    protected $enviromnent;
    
    private $laydirs;
    private $templedirs;
    
    protected $maintenance;


    public function startup() {
	parent::startup();
	
	$this->maintenance = false;
	
	$this->enviromnent = $this->getContext()->getParameters();
	$this->core = $this->getContext()->nesys->core;
	
	$this->template->devel = $this->core->isDevelop();
	$this->template->develMsg = $this->core->getDevelopMsg();
	
	$this->checkMaintenance();
    }
    
    public function formatLayoutTemplateFiles()
      {
          $name = $this->getName();
          $presenter = substr($name, strrpos(':' . $name, ':'));
	  $modul = $this->getModuleName();
          $layout = $this->layout ? $this->layout : 'layout';
	  $params = $this->getContext()->getParameters();
         $dir = dirname($this->getReflection()->getFileName());
         $dir = is_dir("$dir/templates") ? $dir : dirname($dir);
         $list = array(
             "$dir/templates/$presenter/@$layout.latte",
             "$dir/templates/$presenter.@$layout.latte",
             "$dir/templates/$presenter/@$layout.phtml",
              "$dir/templates/$presenter.@$layout.phtml",
         );
	 if (!empty($this->laydirs)) {
	    foreach ($this->laydirs as $laydir) {
		$list[] = $laydir."/@$layout.latte";
		$list[] = $laydir."/@$layout.phtml";
	    }
	  }
          do {
              $list[] = "$dir/templates/@$layout.latte";
              $list[] = "$dir/templates/@$layout.phtml";
	      $list[] = $params["appDir"]."/templates/@$layout.latte";
	      $list[] = $params["appDir"]."/templates/@$layout.phtml";
              $dir = dirname($dir);
          } while ($dir && ($name = substr($name, 0, strrpos($name, ':'))));
	  //dump($list);
         return $list;
      }
    
      
     public function formatTemplateFiles() {
	 $params = $this->getContext()->getParameters();
	 $appdir = $params["appDir"];
	 $name = $this->getName();
         $presenter = substr($name, strrpos(':' . $name, ':'));
         $dir = dirname($this->getReflection()->getFileName());
          $dir = is_dir("$dir/templates") ? $dir : dirname($dir);
	  if (!empty($this->templedirs)) {
	    foreach ($this->templedirs as $templedir) {
		$list[] = $templedir."/$presenter/$this->view.latte";
		$list[] = $templedir."/$presenter/$this->view.phtml";
		$list[] = $templedir."/$presenter.$this->view.latte";
		$list[] = $templedir."/$presenter.$this->view.phtml";
	    }
	  }
	    $list[] = "$dir/templates/$presenter/$this->view.latte";
            $list[] = "$dir/templates/$presenter.$this->view.latte";
            $list[] = "$dir/templates/$presenter/$this->view.phtml";
            $list[] = "$dir/templates/$presenter.$this->view.phtml";
	    $list[] = "$appdir/templates/$presenter/$this->view.latte";
            $list[] = "$appdir/templates/$presenter.$this->view.latte";
            $list[] = "$appdir/templates/$presenter/$this->view.phtml";
            $list[] = "$appdir/templates/$presenter.$this->view.phtml";

          return $list;
     }
     
     /**
      * Returns current user identity, if any.
      * @return IIdentity|NULL
      * @version API-5
      */
     public function getUserIdentity() {
	 return $this->getUser()->getIdentity();
     }
     
     /**
    * Returns Module name
    * @version API-5 
    * @return string
    */
   public function getModuleName()
   {
       $pos = strrpos($this->name, ':');
       if (is_int($pos)) {
	   return substr($this->name, 0, $pos);
       }
       return NULL;
   }

   /**
    * Return presenter pure name
    * @return string
    * @version API-5
    */
   public function getPresenterName()
   {
       $pos = strrpos($this->name, ':');
       if (is_int($pos)) {
	   return substr($this->name, $pos + 1);
       }
       return $this->name;
   }
   
   /**
    * Adds a layout directories
    * @param string $dir
    */
   public function addLayoutDir($dir) {
       $this->laydirs[] = $dir;
   }
   
   public function addTemplateDir($dir) {
       $this->templedirs[] = $dir;
   }
   
   /**
    * Checks maintenance mode
    * @version API-5
    */
   protected function checkMaintenance() {
       if (\file_exists(".maintenance"))
	   $this->setMaintenance();
   }
   
   /**
    * Sets maintenance mode
    * @version API-5
    */
   public function setMaintenance() {
       $this->maintenance = true;
       $this->template->maintenance = $this->maintenance;
       if (!\in_array($_SERVER["REMOTE_ADDR"], \Nesys\NesysCore::$ServiceIPs)) {
	    $this->getHttpResponse()->setHeader("HTTP/1.1", "503 Service Unavailable");
	    echo \file_get_contents(".maintenance");
	    \Nette\Diagnostics\Debugger::$bar = null;
	    $this->terminate();
       }
       else {
	   \Nette\Diagnostics\Debugger::$bar->addPanel(new \MaintenanceBar());
       }
   }
   
}

?>
