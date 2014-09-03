<?php
namespace Nesys;
use Nette;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Opravneni
 *
 * @author JDC
 * @version API-1
 */
class Opravneni extends \Nette\Security\Permission {
    
    /**
     * 
     * @param STRING $role
     * @return string
     * @version API-1
     */
    public function getRoleName($role){
	$rls = array (
	    "guest" => "Host",
	    "user" => "Uživatel",
	    "bj" => "Black Jack",
	    "author" => "Redaktor",
	    "editor" => "Šéfredaktor",
	    "admin" => "Manažer"
	    );
	    return $rls[$role];
    }
    
       public function getCatName($catid) {
	$catnames = array (
	    "koreni" => "Koření",
	    "udalosti" => "Události",
	    "novinky" => "Novinky",
	    "rozhovory" => "Rozhovory",
	    "oznameni" => "Oznámení",
	    "ostatni" => "Ostatní"
	);
	return $catnames[$catid];
    }

      public function getTypName($typid) {
	$catnames = array (
	    "article" => "Články",
	    "sns" => "SNS Updates",
	    "ff" => "FanFikce"
	);
	return $catnames[$typid];
    }
        public function __construct(\Nette\Database\Connection $db) {
	
	    //$db->setDatabaseReflection(new \Nette\Database\Reflection\DiscoveredReflection());
	    //$roles = $db->table("roles")->order("level ASC");
	 
	    //dump($db->query("SELECT * FROM articles INNER JOIN users ON users.id = articles.uid WHERE articles.id = ?",7)->fetch()->user);
	    //přidat role
	    /*foreach ($roles as $role) {
		if ($role->parent != "")
		    $this->addRole($role->role, $role->parent);
		else 
		    $this->addRole($role->role);
		//$role->articles->nadpis;

	    }*/
	    /*$rows = $db->table("articles")->where("id",array(1,2,3,4));
	    foreach ($rows as $row) {
		dump($row->nadpis);
	    }*/
	    //dump($db->table("articles")->where("obsah REGEXP ?","[[:<:]]2ne1[[:>:]]")->fetch()->nadpis);
	    //dump($db->getDatabaseReflection());
	    
	    $this->addRole("guest"); //Neregistrovaný/Nepřihlášený uživatel
	    $this->addRole("user","guest"); //Registrovaný uživatel
	    $this->addRole("bj","user"); //Registrovaný Black Jack
	    $this->addRole("author","bj"); //Redaktor
	    $this->addRole("editor","author"); //Šéfredaktor
	    $this->addRole("admin"); //Manažer
	    //dump($this->getRoles());
	    

	    //Přidat zdroje
	    $this->addResource("my"); //Vlastní články a obsah
	    $this->addResource("article"); //Články
	    $this->addResource("system"); //Administrace a systém
	    $this->addResource("bleskovky"); //Bleskovky
	    $this->addResource("blog"); //Články BJ's blogu
	    $this->addResource("myblog"); //Vlastní články BJ's blogu
	    $this->addResource("comments"); //Komentáře
	    $this->addResource("video"); //Videa
	    $this->addResource("bj-profil"); //BJ's profil

	    //Stanovit oprávnění

	    //User
	    $this->allow("user","comments","add"); //Přihlášený uživatel smí přidávat komentáře
	    
	    //BlackJack
	    $this->allow("bj", "blog", "add");
	    $this->allow("bj", "myblog", array("edit","remove"));
	    $this->allow("bj","bj-profil","have");

	    //Redaktor
	    $this->allow("author", "article", array ("view","add","addToFront")); //Globální pro články
	    $this->allow("author", "my", array("edit","remove","addToFront")); //Pro články a další resources ve vlastnictví autora
	    $this->allow("author", "bleskovky", array("add")); //Smí přidávat beskovky
	    $this->allow("author", "video", array ("view","add","edit"));
	    //$this->allow("author", "system", "view"); //DOČASNÉ! Přístup redaktorům do Adminexu

	    //Šéfredaktor
	    $this->allow("editor", "bleskovky", array("edit","remove")); //smí mazat a upravovat bleskovky
	    $this->allow("editor", "article", array("edit","remove","approve","reject")); //smí upravovat, mazat, schvalovat a vyřazovat články

	    //Manažer
	    $this->allow("admin", \Nette\Security\Permission::ALL, \Nette\Security\Permission::ALL); //Manažer může vše :P ^^
    }
}

?>
