<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\Controls;
use Nette\Application\UI\Control,
	Nette\Utils\Paginator;
/**
 * Description of Navigator
 *
 * @author JDC
 */
class Navigator extends Control {
	
	/** @var \Nette\Utils\Paginator */
	protected $paginator;

	/** @persistent **/
	public $page = 1;
	
	/**
	 * @return Nette\Paginator
	 */
	public function getPaginator()
	{
		if (!$this->paginator) {
			$this->paginator = new Paginator;
		}
		return $this->paginator;
	}
	
	public function render($template = null) {
		
		if (!$template)
			$template = __DIR__ . "/Navigator.latte"; //Default template
		
		$this->template->page = $this->paginator;
		$this->template->setFile($template);
		$this->template->render();
	}

	/**
	 * Loads state informations.
	 * @param  array
	 * @return void
	 */
	public function loadState(array $params)
	{
		parent::loadState($params);
		$this->getPaginator()->page = $this->page;
	}
}
