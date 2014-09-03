<?php

/**
 * Base presenter for all application presenters.
 * @version API-2
 * @package Nesys
 */
abstract class BasePresenter extends Nesys\NesysPresenter
{
    /**
     *
     * @var \Nesys\Opravneni
     */
    protected $perms;
    
    /**
     *
     * @var \Nesys\UserRepository
     */
    private $usrmgr;
    
	/** @var \Ban */
	protected $ban;

	protected $noCookies = false;

    public function startup() {
	parent::startup();
	$this->core = $this->getContext()->nesys->core;
	$this->perms = $this->context->opravneni;
	$this->template->perms = $this->perms;
	$this->usrmgr = $this->context->userRepository;
	$this->ban = $this->context->ban;
	/*
	 * Kontrola BANů
	 */

	if ($this->ban->isBanned($_SERVER["REMOTE_ADDR"])) {
		echo "You are banned due to spam. It is a mistake? Contact administrator <a href='mailto:jdc@2ne1.cz'>jdc@2ne1.cz</a>";
		$this->terminate();
	}
	//Kontrola, zda-li uživatel je nebo není zabanován:
	if ($this->getUser()->isLoggedIn() && $this->context->userRepository->isBanned($this->getUser()->getIdentity()->getId())){
	    //Pokud je uživatel zabanován, splněna tato podmínka, je uživatel odhlášen a přesměrován na login page
	    $this->getUser()->logout(true);
	    $this->flashMessage("Byl(a) jste zabanován z důvodu závažného porušení pravidel.","error");
	    $this->redirect("sign:In");
	}
	
	//Kontrola, zda-li na IP adresu byl či nebyl udělen ban:
	
	//@TODO: Dopsat rutinu pro kontrolu banů IP adres (ještě před tím nadefinovat tabulku IP banů v db)
	
	//////////////////
	

	
	$this->core->log(\Nesys\NesysCore::LOG_ACCESS, "Přístup z ".$_SERVER['REMOTE_ADDR']." do ".$_SERVER['REQUEST_URI']);

		if (count($this->getHttpRequest()->getCookies()) <= 0)
		{
			$this->noCookies = true;
		}

	/*
	 * Informace o přihlášeném uživateli
	 */
	
	//$this->perms = $this->context->opravneni;
	$roles = $this->getUser()->getRoles();
	$this->template->role = $roles[0];
	$this->template->isLoggedIn = $this->getUser()->isLoggedIn();

	if ($this->getUser()->isLoggedIn())
	{
	    $this->template->uzivatel = $this->getUser()->getIdentity()->user;
	    $this->usrmgr->updateActivity($this->getUser()->getId());
	}
	else
	    $this->template->uzivatel = "Guest";
	
    }
    
    public function beforeRender()
    {
		if ($this->getParameter("noCookies"))
			$this->template->noCookies = true;
		if ($this->isAjax())
		{
			//$this->invalidateControl('flashes');
			//$this->invalidateControl("obsah");
			//$this->invalidateControl("downmenu");
		}
		$this->template->sitename = $this->core->getOption("nesys_sitename");
		$this->template->sitedesc = $this->core->getOption("nesys_sitedesc");
    }
    
}
