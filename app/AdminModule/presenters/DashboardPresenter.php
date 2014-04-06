<?php

/* Copyright (c) 2014, JDCofficial
 * All rights reserved.
 *
 * License information you can find in LICENSE.md
 */
namespace App\AdminModule\Presenters;
/**
 * Description of DashboardPresenter
 *
 * @author JDC
 */
class DashboardPresenter extends BasePresenter {
	
	/** @var \App\Model\SongRepository @inject */
	public $songy;
	
	public function actionDefault() {
		$stats = $this->songy->findAll()->select("status, COUNT(id) AS score")->group("status")->fetchPairs("status", "score");
		$stats["all"] = count($this->songy->findAll());
		
		$this->template->songStats = $stats;
	}
}
