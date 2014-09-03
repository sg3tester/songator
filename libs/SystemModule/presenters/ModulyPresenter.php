<?php

/**
 * Description of ModulyPresenter
 *
 * @author JDC
 */
namespace SystemModule;
class ModulyPresenter extends BasePresenter {

    /**
     * (non-phpDoc)
     *
     * @see Nette\Application\Presenter#startup()
     */
    public function startup() {
	parent::startup();
	$this->getComponent('menu')->selectByUrl($this->link('System:control'));
    }

    public function actionDefault() {
	
    }

    public function renderDefault() {
	$this->template->moduly = $this->core->getInstalledModules();
	//dump($this->core->getToolMenu("adminex-content"));
    }
    
    public function renderCheck() {
	$this->template->moduly = array();
	foreach ($this->core->getModuleList() as $modulename){
	    $modul = $this->core->getModule($modulename);
	    $modinfo = $modul->getInfo();
	    $modinfo["name"] = $modul->getReflection()->getName();
	    if (!$this->core->isModuleInstalled($modul->getReflection()->getName()))
		$this->template->moduly[] = $modinfo;
	}
    }
    
    public function handleInstall($modul) {
	try {
	$this->core->installModule($modul);
	$this->flashMessage("Modul $modul byl úspěšně nainstalován","success");
	}
	catch (\Nesys\NesysModuleException $e) {
	    $a = \Nette\Utils\Html::el("b")->setText("Instalace selhala! ");
	    $b = \Nette\Utils\Html::el()->setText($e->getMessage());
	    $c = \Nette\Utils\Html::el()->add($a)->add($b);
	    $this->flashMessage($c, "error");	
	}
	$this->redirect("this");
	
    }
    
    public function handleUpdate($modul) {
	try {
	$this->core->updateModule($modul);
	$this->flashMessage("Modul $modul byl úspěšně aktualizován","success");
	}
	catch (\Nesys\NesysModuleException $e) {
	    $a = \Nette\Utils\Html::el("b")->setText("Aktualizace selhala! ");
	    $b = \Nette\Utils\Html::el()->setText($e->getMessage());
	    $c = \Nette\Utils\Html::el()->add($a)->add($b);
	    $this->flashMessage($c, "error");	
	}
	$this->redirect("this");
    }

        public function handleUninstall($modul,$confirm) {
	if ($this->getUser()->isAllowed("system","remove"))
	{
	    if ($confirm == "ok")
	    {
		$this->core->uninstallModule($modul);
		$this->flashMessage("Modul $modul byl odinstalován. Nyní můžete bezpečně odstranit soubory modulu.");
		$this->redirect("this");
	    }
	    $this->template->param = $modul;
	    $this->template->action = "uninstall!";
	    $this->template->titulek = "Odinstalovat modul";
	    $this->template->zprava = "Opravdu chcete odinstalovat modul $modul?";
	    $this->template->oklabel = "Odinstalovat";
	    $this->template->zpet = "this";
	    $this->setView("confirm");
	}
    }

}