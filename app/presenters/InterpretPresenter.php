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
	}

}
