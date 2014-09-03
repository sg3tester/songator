<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NesysConf
 *
 * @author JDC
 */
namespace Nesys;

/**
 * Nesys Configurator
 * @version API-1
 */
class NesysConf extends \Nette\Config\CompilerExtension
{
    
    public function loadConfiguration()
    {
        $config = $this->getConfig();
	$this->getContainerBuilder()->addDefinition($this->prefix("core"))
		->setClass("Nesys\NesysCore")
		->addSetup("conf",array($config));
    }

}
