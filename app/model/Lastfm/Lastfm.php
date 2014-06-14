<?php
/**
 * Created by PhpStorm.
 * User: JDC
 * Date: 14.6.2014
 * Time: 20:40
 */

namespace App\Model\Lastfm;


use Nette\Http\Url;
use Nette\Object;

/**
 * Last.fm API handler
 * @package App\Model\Lastfm
 * @author JDC
 */
class Lastfm extends Object{

	const DATA_JSON = 'json';

	protected $key;
	protected $data_format;
	/** @var  Url */
	protected $callback_url;

	public function __construct($apikey) {
		$this->key = $apikey;
		$this->data_format = self::DATA_JSON;

		$this->setupCallbackUrl(); //Initialize callback url
	}

	/**
	 * @param string $method
	 * @param array $args
	 * @return \stdClass|string
	 */
	public function call($method, array $args) {

		$this->callback_url->appendQuery('method='.$method); //Assign method

		foreach ($args as $arg => $value) {
			$this->callback_url->appendQuery($arg.'='.urlencode($value));
		}
		//dump($this->callback_url->getAbsoluteUrl());
		$content = file_get_contents($this->callback_url->getAbsoluteUrl());

		if ($this->data_format == self::DATA_JSON) {
			$result = json_decode($content);

			if (isset($result->error))
				throw new LastfmException($method.': '.$result->message, $result->error);

			return $result;
		}
		return $content;
	}

	protected function setupCallbackUrl() {
		//Create and setup callback URL
		$this->callback_url = new Url();
		$this->callback_url->setScheme('http');
		$this->callback_url->setHost('ws.audioscrobbler.com');
		$this->callback_url->setPath('/2.0/'); //2.0 - API version
		$this->callback_url->appendQuery("api_key=$this->key");
		if ($this->data_format == self::DATA_JSON)
			$this->callback_url->appendQuery('format=json'); //JSON result
	}

}

/**
 * Last.fm Exception
 */
class LastfmException extends \Exception {}