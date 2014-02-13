<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{
	
	public function startup() {
	    parent::startup();
	}
	
	
	public function renderDefault()
	{	     
	       $this->template->page = $this->getContext()->obsah->getByShortcut("homepage");
	}
	
	
	public function actionDefault() {
	    
      //enter action homepage here
	    
	}
	
	public function renderKontakt() {
	    $this->template->kontakt = $this->getContext()->obsah->getByShortcut("kontakt")->content;
	}
	
	public function renderDj() {
		 $this->template->page = $this->getContext()->obsah->getByShortcut("dj");
	}
	
	public function renderAsparty() {
		 $this->template->page = $this->getContext()->obsah->getByShortcut("asparty");
		 $this->setView("dj");
	}
	
}
