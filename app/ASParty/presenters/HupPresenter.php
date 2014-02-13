<?php
namespace SystemModule;
/**
 * Description of hup
 *
 * @author JDC
 */
class HupPresenter extends BasePresenter {

    public function startup() {
	parent::startup();
	$this->addTemplateDir("../templates");
	$this->getComponent('menu')->selectByUrl($this->link('System:content'));
    }

    public function actionDefault() {
	$this->getComponent("frmZprava")->SetDefaults(array("zprava" => $this->core->getOption("songator_zprava"), "display" => $this->core->getOption("songator_zprava_show")));
    }

    public function renderDefault() {
	$this->template->status = $this->core->getOption("songator_active");
    }

    public function handleSwitch() {
	if ($this->core->getOption("songator_active"))
	    $this->core->setOption ("songator_active", false);
	else 
	    $this->core->setOption ("songator_active", true);
	$this->redirect("this");
    }
    
    public function createComponentFrmZprava() {
	$form = new \Nette\Application\UI\Form();
	
	$form->addTextArea("zprava");
	$form->addCheckbox("display", "Zobrazit zprávu");
	$form->addSubmit("go","Nastav");
	$form->onSuccess[] = $this->frmZpravaOk;
	
	return $form;
    }
    
    public function frmZpravaOk(\Nette\Application\UI\Form $form) {
	$vals = $form->getValues();
	
	$this->core->setOption ("songator_zprava", $vals->zprava);
	$this->core->setOption ("songator_zprava_show", $vals->display);
    }
	
	public function actionLog() {
		$this->template->logs = $this->getContext()->songylog->findAll()->order("timestamp DESC");
	}
}