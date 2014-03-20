<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{


	/**
	* @var \TwitterAuthenticator
	* @inject
	*/
	public $twitterAuth;
	
	/** @var \App\UserManager @inject */
	public $usrmgr;

	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('username', 'Username:')
			->setRequired('Please enter your username.');

		$form->addPassword('password', 'Password:')
			->setRequired('Please enter your password.');

		$form->addCheckbox('remember', 'Keep me signed in');

		$form->addSubmit('send', 'Sign in');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form)
	{
		$values = $form->getValues();

		if ($values->remember) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->logger->log("auth", "login", array("service" => "songator"));
			$this->redirectAfterLogin();

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionTwitterLogin() {
	    $identity = $this->twitterAuth->authenticate();
	    $this->user->login($identity);
		$this->logger->log("auth", "login", array("service" => "twitter"));
	    $this->redirectAfterLogin();
	}

	public function actionOut()
	{
		$this->logger->log("auth", "logout");
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}
	
	private function redirectAfterLogin() {
		if ($this->usrmgr->getUser($this->user->id)->first_login)
			$this->redirect("Profile:create"); //First login
		$this->redirect('Homepage:');
		
	}

}
