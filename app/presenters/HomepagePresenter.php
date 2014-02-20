<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	public function actionDefault() {
		
		$this->template->page = $this->getPage("home", true);
	}

}
