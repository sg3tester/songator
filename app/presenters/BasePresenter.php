<?php

namespace App\Presenters;

use Nette,
	App\Controls\Navbar,
	App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
	const CONTENT_DIR = "/../../../content";
	
	/** @var \FactoryCreator @inject */
	public $factory;
	
	/** @var \App\Model\NavbarRepository @inject */
	public $navbar;

	protected function getPage($page) {
		$template = $this->createTemplate();
		$template->setFile(__DIR__ . "/../../content/" . $page . ".latte");
		return $template;
	}

	protected function viewPage($page) {		
		$this->setView(self::CONTENT_DIR . "/$page");
	}
	
	protected function createComponentNavbar() {
		$navbar = new Navbar();
		
		foreach ($this->navbar->getAssocSides() as $side) {
			foreach($side as $nav) {
				$control = $this->factory->create($nav->factory);
				$navbar->addControl($nav->dock, $control, "nav_".$nav->id);
				if ($nav->config)
					$control->setup($nav->config);
			}
		}
		
		return $navbar;
	}
}
