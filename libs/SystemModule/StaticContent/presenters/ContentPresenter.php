<?php

namespace SystemModule;
/**
 * Description of ContentPresenter
 *
 * @author JDC
 */
class ContentPresenter extends BasePresenter {

    /** @var \Nesys\StaticContent */
    private $obsah;
    /**
     * (non-phpDoc)
     *
     * @see Nette\Application\Presenter#startup()
     */
    public function startup() {
	$this->obsah = $this->getContext()->obsah;
	$this->getComponent('menu')->selectByUrl($this->link('System:content'));
	parent::startup();
    }

    public function actionDefault() {
	
    }
    
    public function actionEdit($id){
        $data = $this->obsah->getById($id);
        $this['editor']->setDefaults(array(
            'id' => $id, // nebo $id (toto pridat)
            'nazev' => $data['nazev'],
            'content'  => $data['content'],
	    'additional'  => $data['additional'],
	    'shortcut'  => $data['shortcut']
        ));
   }
   
   protected function createComponentEditor() {
       $form = new \Nette\Application\UI\Form;
       $form->addHidden('id'); // (toto pridat)
       $form->addText("nazev", "Název:")
	       ->setAttribute("class", "editor-nadpis")
	       ->setRequired("Musíte zadat název stránky");
       $form->addTextArea("content", "")
	       ->setHtmlId("elm1");
	$form->addTextArea("additional", "JSON data:",80,8);
	$form->addText("shortcut","Shortcut:",20)
		->setOption("description", "Zkratka musí být unikátní!")
		->setRequired("Musíte zadat shortcut");
       
	$form->addSubmit("save", "Uložit")
		    ->setAttribute("class", "button-submit");
	$form->getElementPrototype()->onsubmit('tinyMCE.triggerSave()');
	$form->onSuccess[] = $this->EditorSubmitted;
	
	return $form;
    }

    public function EditorSubmitted(\Nette\Application\UI\Form $form) {
    $values = $form->getValues();
    // pripadne upravy hodnot v $values
    try {
	if (empty($values->id)) {
	    unset($values->id);
	    $p = $this->obsah->createPage($values); // insert
	    $this->flashMessage("Stránka byla uložena", "success");
	    $this->redirect("this", array("id"=>$p->id));
	}
	else {
	    $this->obsah->updatePage($values->id, $values); // update
	    $this->flashMessage("Stránka byla uložena", "success");
	    $this->redirect("this");
	}
    }
    catch (\PDOException $e) {
	$this->flashMessage($e->getMessage(), "error");
    }
    
    }
    
    public function renderDefault() {
	$this->template->obsah = $this->obsah->findAll();
    }

}