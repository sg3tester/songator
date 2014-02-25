<?php

class TwitterAuthenticator
{

	/** @var \App\UserManager */
	private $usermgr;
	private $session;
	private $access;
	private $request;

	public function __construct(array $twitter, \Nette\Http\Session $session, \Nette\Http\Request $request, \App\UserManager $usermgr)
	{
		$this->session = $session;
		$this->access = $twitter;
		$this->request = $request;
		$this->usermgr = $usermgr;
	}

	public function getAuthToken($oauth_verifier = null) {
	    if (\array_key_exists("denied", $this->request->query)) {
		$this->resetToken();
		throw new \Nette\Security\AuthenticationException("Access denied");
	    }

	    $sess = $this->session->getSection("twitter");
	    if (isset($sess->token) && isset($sess->secret)) {
		if (!$oauth_verifier)
		    $oauth_verifier = $this->request->query["oauth_verifier"];
		$oauth = new \TwitterOAuth($this->access["key"], $this->access["secret"], $sess->token, $sess->secret);
		unset($sess->token, $sess->secret);
		return $oauth->getAccessToken($oauth_verifier);
	    }
	    else
		$this->authorize();
	}

	public function resetToken() {
	    $sess = $this->session->getSection("twitter");
	    unset($sess->token, $sess->secret);
	}

		/**
	 * @param stdClass $twitterUser
	 * @return \Nette\Security\Identity
	 */
	public function authenticate($authToken = null)
	{
		if (!$authToken)
		    $authToken = $this->getAuthToken();

		$user = $this->usermgr->getByServiceToken("twitter", $authToken["user_id"]);

		if (!$user)
			$user = $this->register($authToken);

		return new \Nette\Security\Identity($user->id, "user", $user);
	}

	public function register($info)
	{
		return $this->usermgr->addViaTwitter($info["screen_name"], $info["user_id"]);
	}

	public function updateMissingData($user, stdClass $info)
	{

	}

	private function authorize() {
	    $oauth = new \TwitterOAuth($this->access["key"], $this->access["secret"]);

		// vyžádáme si request token
		$requestToken = $oauth->getRequestToken();

		$sess = $this->session->getSection("twitter");
		// uložíme request token do sessions
		$sess->token = $requestToken['oauth_token'];
		$sess->secret = $requestToken['oauth_token_secret'];

		// získáme URL autentizačního serveru
		$url = $oauth->getAuthorizeURL($requestToken['oauth_token']);

		header('Location: ' . $url,  TRUE, 301);
		exit;
	}

}
