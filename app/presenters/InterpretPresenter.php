<?php

namespace App\Presenters;

use App\Console\RefreshSongCommand;
use Nette,
	App\Model,
	\Nette\Diagnostics\Debugger;
use Symfony\Component\Console\Output\NullOutput;


/**
 * Homepage presenter.
 */
class InterpretPresenter extends BasePresenter
{

	/** @var \App\Model\InterpretRepository @inject */
	public $interpreti;

	/** @var  \App\Model\Lastfm\Lastfm @inject */
	public $lastfm;

	public function actionList($q, $noaliases) {

		$interpreti = $this->interpreti->findAll()->order("nazev ASC");
		
		if($q) {
			$interpreti->where("nazev LIKE ",$q."%");
		}
		
		if($noaliases) {
			$interpreti->where("interpret_id IS NULL");
		}
		
		$this->template->interpreti = $interpreti;
		$this->template->noaliases = $noaliases;
		$this->template->q = $q;
	}

	/**
	 * @param $id
	 * @throws \Nette\Application\BadRequestException
	 */
	public function actionView($id) {
		$interpret = $this->interpreti->find($id);
		
		if(!$interpret)
			throw new Nette\Application\BadRequestException("Interpret does not exists!", 404);
		
		if($interpret->interpret_id) {
			$msg = $this->flashMessage("Přesměrováno z '$interpret->nazev'");
			$msg->title = "Alias";
			$this->redirect ("this", array("id" => $interpret->interpret_id)); //If is alias => redirect to real
		}

		$this->template->interpret = $interpret;

		//Register helper fot fetching song form last.fm
		$this->template->registerhelper('songImage', function($song, $img = 0) {
			try {
				return $this->lastfm->call('Track.getInfo', ['track' => $song->name, 'artist' => $song->interpret_name])
					->track->album->image[$img]->{'#text'};
			} catch (Model\Lastfm\LastfmException $e) {
				return null;
			}
		});

		//Last.fm Interpret info (images)
		try {
			$this->template->lastfm = $this->lastfm->call('Artist.getInfo', ['artist' => $interpret->nazev])->artist;
		}
		catch (Model\Lastfm\LastfmException $e) {
			if($this->settings->get('lastfm_enabled', false))
				Debugger::log($e);
		}
	}

}
