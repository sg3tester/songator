<?php
namespace SystemModule;
use Nette;
use Nette\Application\UI;
/**
 * Description of System
 *
 * @author JDC
 */
class SystemPresenter extends BasePresenter {

    /**
     * (non-phpDoc)
     *
     * @see Nette\Application\Presenter#startup()
     */
    
    /** @var \Nesys\UserRepository */
    private $usermgr;
    private $cuid; //Selected user ID
    private $cusr; //Selected user
    private $filter;
    private $by;


    public function startup() {
	parent::startup();
	
	$this->usermgr = $this->context->userRepository;
	$this->getComponent('menu')->selectByUrl($this->link('this'));
    }

    public function actionUsers($filter, $by) {
	$this->filter = $filter;
	$this->template->filter = $filter;
	$this->by = $by;
	$this->getComponent('menu')->selectByUrl($this->link('System:users'));
	$this->getComponent('tridic')->selectByUrl($this->link('this'));
    }
    
    public function actionUser($id) {
	if (isset($id)){
	    $this->cuid = $id;
	    $this->cusr = $this->usermgr->getUser($id);
	    $this->template->titulek = "Upravit uživatele";
	    $this->template->cuid = $id;
	}
	else {
	    $this->template->titulek = "Vytvořit uživatele";
	}
    }

    public function actionLogging($id,$type) {
	$this->getComponent('menu')->selectByUrl($this->link('System:logging'));
	if (\Nesys\NesysCore::API < 3) {
	    $this->flashMessage("Tento api level (API-".\Nesys\NesysCore::API.") nepodporuje funkci logování.");
	    $this->redirect("system:");
	}
	
	if ($id == null) {
	    $id = \date("Y-m-d",time());
	}
	
	if ($type == null) {
	    $type = \Nesys\NesysCore::LOG_ACCESS;
	}
	
	$this["logSelect"]->setDefaults(array ("log" =>$id, "type" => $type));
	
	if (\file_exists("log/".$type."_".$id.".log")) {
	    $log = \file_get_contents("log/".$type."_".$id.".log");
	    $this->template->log = \str_replace("\n", "<br />", $log);
	}
	else 
	    $this->template->log = "<h3>Tento log není v žádném ze záznamů</h3>";
    }

    public function renderDefault() {
	$this->template->usrcount = $this->usermgr->getUserCount();
	$this->template->admincount = $this->usermgr->getRoleCount("admin");
	$this->template->sefredaktorcount = $this->usermgr->getRoleCount("editor");
	$this->template->redaktorcount = $this->usermgr->getRoleCount("author");
	$this->template->bjcount = $this->usermgr->getRoleCount("bj");
	$this->template->regusercount = $this->usermgr->getRoleCount("user");
	$roles = $this->getUser()->getRoles();
	$this->template->role = $roles[0];
	$this->template->isLoggedIn = $this->getUser()->isLoggedIn();
	$this->template->online = $this->usermgr->getActiveUsers();
    }
    
    public function renderContent() {
	if ($this->core->isModuleInstalled("Nesys\ArticlesModule")) {
	$this->template->articlecount = $this->context->articles->getArticles()->count();
	//dump($this->core->getToolMenu("adminex-content")[0]->toArray());
	}
	$this->template->usrcount = $this->usermgr->getUserCount();
	$this->template->contentmenu = $this->core->getToolMenu("adminex-content");
    }
    
    public function  renderUsers() {
	//dump($this->filter);
	if ($this->filter == "ban"){
	    $this->template->userList = $this->usermgr->getUsers()->where("banned",true);
	    $this->template->usrcount = $this->usermgr->getUsers()->where("banned",true)->Count();
	}
	elseif ($this->filter == "role") {
	    $this->template->userList = $this->usermgr->getUsers()->where("role", $this->by);
	    $this->template->usrcount = $this->usermgr->getUsers()->where("role", $this->by)->Count();
	}
	else {
	    $this->template->userList = $this->usermgr->getUsers();
	    $this->template->usrcount = $this->usermgr->getUserCount();
	}
	
    }
    
    public function renderUser(){
    $this->getComponent('menu')->selectByUrl($this->link('System:users'));
    }

    //Handling actions
    public function handleeditUser($id)
    {
	$this->redirect("System:user", array('id' => $id));
    }
    
    public function handledeleteUser($id, $confirm){
	if ($this->getUser()->isAllowed("system","remove"))
	{
	    if ($confirm == "ok")
	    {
		$this->usermgr->deleteUser($id);
		$this->redirect("this");
	    }
	    $this->template->param = $id;
	    $this->template->action = "deleteUser!";
	    $this->template->titulek = "Smazat uživatele";
	    $this->template->zprava = "Opravdu chcete smazat tohoto uživatele?";
	    $this->template->oklabel = "Smazat";
	    $this->template->zpet = "this";
	    $this->setView("confirm");
	}
	    
    }
    
    public function handlebanUser($id, $confirm) {
	if ($this->getUser()->isAllowed("system","remove"))
	{
	    if ($confirm == "ok")
	    {
		$this->usermgr->banUser($id);
		$this->redirect("this");
	    }
	    $this->template->param = $id;
	    $this->template->action = "banUser!";
	    $this->template->titulek = "Udělit ban";
	    $this->template->zprava = "Opravdu chcete udělit ban tomuto uživateli?";
	    $this->template->oklabel = "Zabanovat";
	    $this->template->zpet = "this";
	    $this->setView("confirm");
	}
    }
    
    /**
     * Akce: Odbanuj uživatele
     * @param type $id
     * @param type $confirm
     */
    public function handleunbanUser($id, $confirm) {
	if ($this->getUser()->isAllowed("system","remove"))
	{
	    if ($confirm == "ok")
	    {
		$this->usermgr->unbanUser($id);
		$this->redirect("this");
	    }
	    $this->template->param = $id;
	    $this->template->action = "unbanUser!";
	    $this->template->titulek = "Odebrat ban";
	    $this->template->zprava = "Opravdu chcete osvobodit z banu tohoto uživatele?";
	    $this->template->oklabel = "Odbanovat";
	    $this->template->zpet = "this";
	    $this->setView("confirm");
	}
	    
    }
    
    public function createComponentUserForm(){
	$form = new UI\Form();
	$form->addText("user", "Uživatelské jméno: ")
		->setRequired("Musíta zadat uživatelské jméno");
	$form->addText("mail","E-mail: ")
		->setRequired("Musíte zadat E-mail uživatele")
		->addRule(UI\Form::EMAIL, "E-mailová adresa je neplatná");
	$form->addPassword("pass", "Heslo:")
		    ->setRequired("Zvolte si prosím heslo");
	$form->addPassword("pass2", "Heslo znovu:")
		    ->setRequired("Zadejte heslo pro kontrolu ještě jednou.")
		    ->addRule(UI\Form::EQUAL, "Zadaná hesla se neshodují!", $form["pass"]);
	$form->addSelect("pohlavi", "Pohlaví: ", array("H" => "Hermafrodit", "M" => "Muž", "F" => "Žena"));
	$form->addSelect("role", "Role: ", array("admin" => "Manažer", "editor" => "Šéfredaktor", "author" => "Redaktor", "bj" => "Black Jack", "user" => "Uživatel"));

	    $form->addSubmit("register", "Založit účet")
		    ->setAttribute("class", "button-submit");
	    $form->onSuccess[] = $this->userFormSucceeded;
	return $form;
	
    }
    
    public function createComponentEditUserForm(){
	$form = new UI\Form();
	$form->addText("user", "Uživatelské jméno: ")
		->setRequired("Musíta zadat uživatelské jméno")
		->setValue($this->cusr->user);
	$form->addText("mail","E-mail: ")
		->setRequired("Musíte zadat E-mail uživatele")
		->addRule(UI\Form::EMAIL, "E-mailová adresa je neplatná")
		->setValue($this->cusr->mail);
	$form->addPassword("pass", "Heslo:");
	$form->addPassword("pass2", "Heslo znovu:")
		    ->addRule(UI\Form::EQUAL, "Zadaná hesla se neshodují!", $form["pass"]);
	$form->addSelect("pohlavi", "Pohlaví: ", array("H" => "Hermafrodit", "M" => "Muž", "F" => "Žena"))
		->setValue($this->cusr->pohlavi);
	$form->addSelect("role", "Role: ", array("admin" => "Manažer", "editor" => "Šéfredaktor", "author" => "Redaktor", "bj" => "Black Jack", "user" => "Uživatel"))
		->setValue($this->cusr->role);
	$form->addText("funkce", "Funkce:")
		->setValue($this->cusr->funkce);
	   $form->addSubmit("register", "Upravit účet")
		   ->setAttribute("class", "button-submit");
	    $form->onSuccess[] = $this->userEditFormSucceeded;
	return $form;
    }

        public function userFormSucceeded(UI\Form $form) {
	    
	    if ($form->isValid()) {
		$values = $form->getValues();
		try {
		$this->usermgr->RegisterUser($values->user,$values->pass,$values->mail);
		$uid = $this->usermgr->getUid($values->user);
		$this->usermgr->setRole($uid,$values->role);
		$this->usermgr->setGender($uid,$values->pohlavi);
		$this->flashMessage("Uživatel úspěšně vytvořen!", "success");
		$this->redirect("this", array("id" => $uid));
		}
		catch (Nette\Security\AuthenticationException $vyjimka){
		    $form->addError($vyjimka->getMessage());
		}
	    }
	    else {
		$form->addError("Odeslány neplatné údaje");
	    }
	    
	    
	}
	
	public function userEditFormSucceeded(UI\Form $form)
	{
	    if ($form->isValid()) {
		$values = $form->getValues();
		$this->usermgr->updateUser($this->cuid,$values->user,$values->mail);
		$this->usermgr->setRole($this->cuid,$values->role);
		$this->usermgr->setGender($this->cuid,$values->pohlavi);
		if ($values->pass != ""){
		    $this->usermgr->changePass($this->cuid,$values->pass);
		}
		$this->usermgr->setCustom($this->cuid, "funkce", $values->funkce);
		$this->flashMessage("Uživatel úspěšně upraven!", "success");
		$this->redirect("this", array("id" => $this->cuid));
	    }
	    else {
		$form->addError("Odeslány neplatné údaje");
	    }
	}
	
	public function createComponentTridic(){
	    $menu = new \Murdej\Menu;
	    
	    $item = new \Murdej\MenuNode;
	    $item->link = "System:users";
	    $item->name = "Vše";
	    
	    $menu->rootNode->add($item);
	    
	    $item = new \Murdej\MenuNode;
	    $item->link = array('this', array("filter" => "role", "by" => "admin"));
	    $item->name = "Manažer";
	    $menu->rootNode->add($item);
	    
	    $item = new \Murdej\MenuNode;
	    $item->link = array('this', array("filter" => "role", "by" => "editor"));
	    $item->name = "Šéfredaktor";
	    $menu->rootNode->add($item);
	    
	    $item = new \Murdej\MenuNode;
	    $item->link = array('this', array("filter" => "role", "by" => "author"));
	    $item->name = "Redaktor";
	    $menu->rootNode->add($item);
	    
	    $item = new \Murdej\MenuNode;
	    $item->link = array('this', array("filter" => "role", "by" => "bj"));
	    $item->name = "Black Jack";
	    $menu->rootNode->add($item);
	    
	    $item = new \Murdej\MenuNode;
	    $item->link = array('this', array("filter" => "role", "by" => "user"));
	    $item->name = "Uživatel";
	    
	    $menu->rootNode->add($item);
	    return $menu;
	}
	
	public function createComponentFormSystem(){
	    $form = new UI\Form;
	    $form->addText("sitename","Název stránky: ",50)
		    ->setValue($this->core->getOption("nesys_sitename"));
	    $form->addText("sitedesc","Popis stránky: ",50)
		    ->setValue($this->core->getOption("nesys_sitedesc"));
	    $form->addText("webmaster","Provozovatel: ",50)
		    ->setValue($this->core->getOption("nesys_webmaster"));
	    $form->addText("sitemail","E-mail stránky: ",50)
		    ->setValue($this->core->getOption("nesys_sitemail"))
		    ->addRule(UI\Form::EMAIL,"Zadejte platnou e-mailovou adresu");
	    $form->addSubmit("siteupdate", "Aktualizovat")
		    ->setAttribute("class", "button-submit");
	    $form->onSuccess[] = $this->formSystemSucceeded;
	    return $form;
	}
	
	public function formSystemSucceeded(\Nette\Application\UI\Form $form) {
	    $values = $form->getValues(true);
	    foreach ($values as $option => $value) {
		$r = $this->core->setOption("nesys_".$option, $value);
		//dump(false);
		/*if ($r == false) {
		    $this->flashMessage("Nastavení systému selhalo. Option $option cannot be set", "error");
		    $this->redirect("this");
		    break;
		}*/
	    }
	    $this->flashMessage("Systém byl úspěšně nastaven", "success");
	    $this->redirect("this");
	    
	}
	
	public function createComponentLogSelect() {
	    $form = new \Nette\Application\UI\Form();
	    
	    $form->addText("log")
		    ->setHtmlId("datepicker")
		    ->setRequired();
	    
	    $form->addSelect("type", "", array(\Nesys\NesysCore::LOG_ACCESS => "přístup", \Nesys\NesysCore::LOG_ACTION => "akce",  \Nesys\NesysCore::LOG_ADMIN => "admin",  \Nesys\NesysCore::LOG_ERROR => "error", \Nesys\NesysCore::LOG_USER => "uživatel"));
	    
	    $form->addSubmit("view", "Zobraz")
		    ->setAttribute("class", "button-submit");
	    
	    $form->addProtection();
	    $form->onSuccess[] = $this->setLog;
	    
	    return $form;
	}
	
	public function setLog(\Nette\Application\UI\Form $form) {
	    $this->redirect("this",array("id" => $form->getValues()->log, "type" => $form->getValues()->type));
	}
	
}