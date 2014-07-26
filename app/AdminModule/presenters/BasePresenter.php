<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\AdminModule\Presenters;
/**
 * Description of BasePresenter
 *
 * @author JDC
 */
abstract class BasePresenter extends \Nette\Application\UI\Presenter {

	use \LinkParserTrait;

	/** @var \App\Model\SongRepository @inject */
	public $songy;

	/** @var  \Navigation @inject */
	public $navigation;

	public function beforeRender() {
		$stats = $this->songy->findAll()->select("status, COUNT(id) AS score")->group("status")->fetchPairs("status", "score");
		$stats["all"] = count($this->songy->findAll());

		$this->template->navigation = $this->navigation;
		$this->template->songy = $this->songy;
		$this->template->songStats = $stats;
		$this->template->songGraph = $this->songy->findAll()
			->select("DATE(datum) AS datum, COUNT(datum) AS score")
			->group("DATE(datum)")
			->order("datum DESC");
	}

}
