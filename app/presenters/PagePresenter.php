<?php

namespace App\Presenters;

use Nette,
	App\Model;

/**
 * Page presenter.
 */
class PagePresenter extends BasePresenter
{
	
	public function beforeRender() {
		$this->template->page = $this->getPage($this->getAction());
		$this->setView("../Homepage/default");
	}

}
