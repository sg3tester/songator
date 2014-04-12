<?php

namespace App\Presenters;

use Nette,
	App\Controls\Navbar,
	App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class PrimePresenter extends Nette\Application\UI\Presenter
{
	const CONTENT_DIR = "/../../../content";

	/** @var \FactoryCreator @inject */
	public $factory;

	/** @var \App\Model\NavbarRepository @inject */
	public $navbar;

	/** @var \App\Model\ContentRepository @inject */
	public $pages;
	
	/** @var \App\Model\Logging\Logger @inject */
	public $logger;
	
	/** @var \TwitterAccess @inject */
	public $twitter;
	
	/** @var \Settings @inject */
	public $settings;
	
	/** @var \Status */
	public $status;

	protected $conf;
	
	protected function startup() {
		parent::startup();
		
		//Check maintenance mode
		if (file_exists($this->conf["wwwDir"] . "/.maintenance"))
			$this->setView ("../maintenance");
		
		//Set songator status
		$enabled = $this->settings->get("portal_enabled", true);
		$adding = $this->settings->get("adding_enabled", true);
		$msg = $this->settings->get("portal_message");
		$this->status = new \Status($enabled, $adding, $msg);
		
		//Compiling less theme
		$appDir = $this->conf["appDir"];
		$wwwDir = $this->conf["wwwDir"];
		$theme = $this->settings->get("theme", "default");
		
		$less = new \Lessify();
		$less->cacheDir = $this->conf["tempDir"]."/less/";
		$less->compile($appDir . "/templates/themes/$theme/$theme.less", $wwwDir . "/css/style.css");
		
		$this->template->settings = $this->settings;
	}

	protected function getPage($page, $xray = false) {
		$source = $this->pages->getPage($page, $xray);

		if (!$source) {
			throw new Nette\Application\BadRequestException("Page '$page' not found");
		}
		if ($source->data)
			$data = \Nette\Utils\Json::decode($source->data);
		else
			$data = null;
		$template = $this->createTemplate("\Nette\Templating\Template");
		$template->heading = $source->heading;
		$template->data = $data;
		$template->setSource($source->body);
		return $template;
	}

	protected function viewPage($page) {
		$this->setView(self::CONTENT_DIR . "/$page");
	}

	public function injectParameters(\Nette\DI\Container $di) {
		$this->conf = $di->getParameters();
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
	
	protected function checkPermissions($resource, $privilege, $mustLoggedIn = true) {
		if ($mustLoggedIn && !$this->user->isLoggedIn()) {
			$this->flashMessage("Nejprve se musíte přihlásit", "warning");
			$this->redirect("sign:in");
		}
		
		if (!$this->user->isAllowed($resource, $privilege)) {
			$this->flashMessage("Nemáte dostatečná oprávnění", "danger");
			return false;
		}
		
		return true;
	}

	public function createTemplate($class = NULL)
    {
		$helpers = new \App\Helpers\Helpers();
        $template = parent::createTemplate($class);
        $template->registerHelperLoader(callback(
            $helpers,
            'loader'
        ));
        return $template;
    }
	
	protected function beforeRender() {
		parent::beforeRender();
		$this->template->portal = $this->status;
	}
}
