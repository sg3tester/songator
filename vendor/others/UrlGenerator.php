<?php

use Nette\Application\IRouter;
use Nette\Application\UI\InvalidLinkException;
use Nette\Application\UI\Presenter;
use Nette\Application;
use Nette\Http\Url;
use Nette\Object;

/**
 * @author David Matějka
 * @author David Grudl
 */
class UrlGenerator extends Object
{

	/** @var \Nette\Application\IRouter */
	protected $router;

	/** @var \Nette\Http\Url */
	protected $refUrl;


	/**
	 * @param Url $refUrl
	 * @param IRouter $router
	 */
	public function __construct(Url $refUrl, IRouter $router)
	{
		$this->refUrl = $refUrl;
		$this->router = $router;
	}


	/**
	 * URL factory.
	 *
	 * @param string $destination in format "[module:]presenter:action"
	 * @param array $args array of arguments
	 * @return string URL
	 * @throws InvalidLinkException
	 */
	public function link($destination, array $args = array())
	{
		$a = strpos($destination, '#');
		if ($a === FALSE) {
			$fragment = '';
		} else {
			$fragment = substr($destination, $a);
			$destination = substr($destination, 0, $a);
		}

		$a = strpos($destination, '?');
		if ($a !== FALSE) {
			parse_str(substr($destination, $a + 1), $args); // requires disabled magic quotes
			$destination = substr($destination, 0, $a);
		}

		$a = strpos($destination, '//');
		if ($a !== FALSE) {
			$destination = substr($destination, $a + 2);
		}


		if ($destination == NULL) { // intentionally ==
			throw new InvalidLinkException("Destination must be non-empty string.");
		}

		$a = strrpos($destination, ':');
		$action = (string) substr($destination, $a + 1);
		$presenter = substr($destination, 0, $a);
		if ($presenter[0] == ":") {
			$presenter = substr($presenter, 1);
		}
		if (!$action) {
			$action = 'default';
		}

		$args[Presenter::ACTION_KEY] = $action;

		$request = new Application\Request(
			$presenter,
			Application\Request::FORWARD,
			$args,
			array(),
			array()
		);

		$url = $this->router->constructUrl($request, $this->refUrl);
		if ($url === NULL) {
			unset($args[Presenter::ACTION_KEY]);
			$params = urldecode(http_build_query($args, NULL, ', '));
			throw new InvalidLinkException("No route for $presenter:$action($params)");
		}

		return $url . $fragment;
	}

}