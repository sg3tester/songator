<?php

/**
 * Description of InterpretiPresenter
 *
 * @author JDC
 */
class InterpretiPresenter extends BasePresenter {

    /** @var \Nesys\Podobne */
    private $interpreti;
    /** @var \Nesys\Songy */
    private $songy;
    /**
     * (non-phpDoc)
     *
     * @see Nette\Application\Presenter#startup()
     */
    public function startup() {
	parent::startup();
	$this->interpreti = $this->getContext()->podobne;
	$this->songy = $this->getContext()->songy;
    }

    public function actionDefault() {
	
    }

    public function renderDefault() {
	$this->template->interpreti = $this->interpreti->findAll()->order("valid ASC");
    }
    
    public function actionDetail($id) {
	$interpret = $this->interpreti->findAll()->get($id);
	$aliasy = \str_replace(",", "|", $interpret->aliases);
	$id= str_replace("(", "\\(", $id);
	$id = str_replace(")", "\\)", $id);
	$aliasy = str_replace("(", "\\(", $aliasy);
	$aliasy = str_replace(")", "\\)", $aliasy);
	$this->template->interpret = $interpret;
	$this->template->songy = $this->songy->findAll()->where("interpret REGEXP ?",$id."|".$aliasy)->order("song ASC");
    }

}