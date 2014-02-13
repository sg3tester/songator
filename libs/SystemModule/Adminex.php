<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace SystemModule;
/**
 * Description of Adminex
 *
 * @author JDC
 */
class Adminex {
    
    const VERSION = "1.1";


    static function getAdminexDir() {
	return __DIR__;
    }
    
    static function getAdminexTemplateDir() {
	return __DIR__."/templates";
    }
}

?>
