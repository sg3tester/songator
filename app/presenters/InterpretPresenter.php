<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class InterpretPresenter extends BasePresenter
{

	/** @var \App\Model\InterpretRepository @inject */
	public $interpreti;
	
	public function actionList($q, $noaliases) {

		$interpreti = $this->interpreti->findAll()->order("nazev ASC");
		
		if($q) {
			$interpreti->where("nazev LIKE ",$q."%");
		}
		
		if($noaliases) {
			$interpreti->where("interpret_id IS NULL");
		}
		
		$this->template->interpreti = $interpreti;
		$this->template->noaliases = $noaliases;
		$this->template->q = $q;
	}
	
	public function actionView($id) {
		$interpret = $this->interpreti->find($id);
		
		if(!$interpret)
			throw new Nette\Application\BadRequestException("Interpret does not exists!", 404);
		
		if($interpret->interpret_id) {
			$msg = $this->flashMessage("Přesměrováno z '$interpret->nazev'");
			$msg->title = "Alias";
			$this->redirect ("this", array("id" => $interpret->interpret_id)); //If is alias => redirect to real
		}
		
		$this->template->interpret = $interpret;
	}

}
