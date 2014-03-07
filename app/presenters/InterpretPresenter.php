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
	
	public function actionList() {

		$this->template->interpreti = $this->interpreti->findAll()->order("nazev ASC");
	}

}
