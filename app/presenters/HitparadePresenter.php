<?php

namespace App\Presenters;

/**
 * Description of HitparadePresenter
 *
 * @author JDC
 */
class HitparadePresenter extends BasePresenter {

	/** @var \App\Model\SongRepository @inject */
	public $songList;

	public function renderDefault($filter) {
		
		//If filter is empty => redirect to default filter
		if (!$filter)
			$this->redirect('this',['filter' => 'last-month']);
		
		$this->template->filter = $filter;
		
		
		//Filter mapping
		switch ($filter) {
			case 'last-month':
				$filter = '1 month';
				break;
			case 'last-week':
				$filter = '1 week';
				break;
			default:
				$filter = null;
		}
		$this->template->songs = $this->songList->getTopSongs(10, $filter);
		$this->template->newest = $this->songList->findAll()->order("datum DESC")->limit(5);
	}

}
