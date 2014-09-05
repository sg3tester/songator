<?php

namespace App\Model\Lastfm;

/**
 * Last.fm API data fetcher
 *
 * @author JDC
 */
class Databox extends \Nette\Object {
	
	protected $api;
	protected $silentMode = true;


	public function __construct(Lastfm $api) {
		$this->api = $api;
	}
	
	
	public function getTrackImage($interpret, $track) {
		//Fetch song album image form Last.fm
		$image = null;
		try {
			$lfm = $this->api;
			return $lfm->call('Track.getInfo', ['artist' => $interpret, 'track' => $track])
					->track->album->image;
		} catch (Model\Lastfm\LastfmException $e) {
			if (!$this->silentMode)
				throw $e;
		}
	}
	
	public function setSilentMode($enabled) {
		$this->silentMode = true;
	}
	
	public function getSilentMode() {
		return $this->silentMode;
	}
	
}
