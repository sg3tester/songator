<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class BlogPresenter extends BasePresenter
{

	/** @var \App\Model\BlogRepository @inject */
	public $blog;
	
	public function actionDefault() {
		
	}
	
	public function renderDefault() {
		$this->template->articles = $this->blog->findAll();
	}

}
