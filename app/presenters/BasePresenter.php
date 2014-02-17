<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
	protected function viewPage($page) {
		$contentDir = "/../../../content";		
		$this->setView($contentDir . "/$page");
	}
}
