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
		$home = $this->settings->get("page_home");
		if ($home)
			$this->template->page = $this->getPage($home, true);
		else
			throw new nette\Application\BadRequestException("homepage not found", 404);
	}

}
