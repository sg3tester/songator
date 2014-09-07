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

	protected function createComponentRegisterForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('username', 'Username:')
			->addRule(\Nette\Application\UI\Form::MIN_LENGTH, "Uživatelské jméno musí mít minimálně %d znaků.", 3)
			->setRequired('Musíte si zvolit uživatelské jméno');
		
		$form->addText('email', 'Email')
			->addRule(\Nette\Application\UI\Form::EMAIL, "E-mail není v platném formátu")
			->setRequired('Zadejte platný e-mail');

		$form->addPassword('password', 'Heslo:')
			->addRule(\Nette\Application\UI\Form::MIN_LENGTH, "Heslo musí mít minimálně %d znaků.", 6)
			->setRequired('Musíte si zvolit heslo');
		
		$form->addPassword('verify', 'Kontrola hesla:')
			->addRule(\Nette\Forms\Form::EQUAL, "Hesla se neshodují", $form["password"])
			->setRequired('Zadejte heslo ještě jednou');


		$form->addSubmit('send', 'Vytvořit účet');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->registerFormSuccess;
		return $form;
	}

	public function registerFormSuccess($form) {
		$val = $form->values;
		
		try {
			$this->usrmgr->add($val->username, $val->password, $val->email);
			$this->flashMessage("Registrace proběhla v pořádku", "success");
			$this->redirect("in");
		}
		catch (\App\UserManagerException $ex) {
			$form->addError($ex->getMessage());
		}
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
			$this->logger->log("auth", "login", "Přihlásil se uživatel %user%");
			$this->redirectAfterLogin();

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionTwitterLogin() {
	    $identity = $this->twitterAuth->authenticate();
	    $this->user->login($identity);
		$this->logger->log("auth", "login", "Uživatel %user% se přihlásil prostřednictvím Twitteru");
	    $this->redirectAfterLogin();
	}

	public function actionOut()
	{
		$this->logger->log("auth", "logout", "Uživatel %user% se odhlásil");
		$this->getUser()->logout(true);
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}
	
	private function redirectAfterLogin() {
		if ($this->usrmgr->getUser($this->user->id)->first_login)
			$this->redirect("Profile:create"); //First login
		$this->redirect('Homepage:');
		
	}

}
