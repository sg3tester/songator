<?php

use Nette\Application\UI;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

	private $user;
	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	
	public function startup() {
	    parent::startup();
	    $this->user = $this->context->userRepository;
	}
	protected function createComponentSignInForm()
	{
		$form = new UI\Form;
		$form->getElementPrototype()->class("ajax");
		$form->addText('username', 'Uživatel: ')
			->setRequired('Prosím vyplňte uživatelské jméno.');

		$form->addPassword('password', 'Heslo: ')
			->setRequired('Prosím zadejte heslo.');

		$form->addCheckbox('remember', ' Pamatuj si mě.');

		$form->addSubmit('send', 'Přihlásit')
			->setAttribute("class", "button-submit");

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}
	
	/*protected function createComponentSignUpForm() {
	    $form = new UI\Form;
	    
	    $form->getElementPrototype()->class("ajax");
	    $form->addText("user", "Uživatelské jméno: ")
		    ->setRequired("Zadejte Vaše uživatelské jméno");
	    $form->addText("mail","E-Mail: ")
		    ->setRequired("Zadejte Vaší e-mailovou adresu.")
		    ->addRule(UI\Form::EMAIL, "E-mailová adresa není platná");
	    $form->addPassword("pass", "Heslo: ")
		    ->setRequired("Zvolte si prosím heslo")
		    ->addRule(UI\Form::MIN_LENGTH,"Heslo musí mít minimálně 6 znaků",6);
	    $form->addPassword("pass2", "Heslo znovu: ")
		    ->setRequired("Zadejte heslo pro kontrolu ještě jednou.")
		    ->addRule(UI\Form::EQUAL, "Zadaná hesla se neshodují!", $form["pass"]);
	    $form->addSubmit("register", "Založit účet")
		    ->setAttribute("class", "button-submit");
	    $form->onSuccess[] = $this->signUpFormSucceeded;
	    return $form;
	}*/



	public function signInFormSucceeded($form)
	{
		$values = $form->getValues();

		if ($values->remember) {
			$this->getUser()->setExpiration('30 days', FALSE);
		} else {
			$this->getUser()->setExpiration('30 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->presenter->flashMessage("Příhlášení proběhlo úspěšně!", "success");
			$this->invalidateControl("signInForm");
			$this->invalidateControl("validace");
			$this->invalidateControl("flashes");
			$this->redirect('Homepage:');
			
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
			$this->invalidateControl("signInForm");
			$this->invalidateControl("validace");
			$this->invalidateControl("flashes");
		}
		
	}
	
	/*public function signUpFormSucceeded(UI\Form $form) {
	    
	    if ($form->isValid()) {
		$values = $form->getValues();
		try {
		    $this->user->RegisterUser($values->user,$values->pass,$values->mail);
		    $mail = new \Nette\Mail\Message;
		    $mail->setFrom("noreply@2ne1.cz","Portál 2NE1 CZ&SK fanbase");
		    $mail->addTo($values->mail);
		    $mail->setSubject("Registrace na portále 2NE1.cz");
		    $mail->setHtmlBody("Annyeong, <b>".$values->user."</b>,<br /> Tvůj účet na 2NE1.cz byl vytvořen. Můžeš se na něj přihlásit.");
		    $mail->send();
		    
		    $bonz = new \Nette\Mail\Message;
		    $bonz->setFrom("service@2ne1.cz","Administrační služba portálu 2NE1.cz");
		    $bonz->addTo("redakce@2ne1.cz");
		    $bonz->setSubject("Registrace na portále 2NE1.cz");
		    $bonz->setHtmlBody("Annyeong,<br /> Zaregistroval se nový uživatel <b>".$values->user.",</b> Pokud chcete tohoto uživatele spravovat, přejděte do adminexu portálu 2NE1.cz");
		    $bonz->send();
		    
		    $e2 = Nette\Utils\Html::el('span', "Registrace proběhla úspěšně. ");
		    $e = Nette\Utils\Html::el('a',"Přihlásit se.")->href($this->link("sign:in"));
		    $e2->add($e);
		    $this->presenter->flashMessage($e2, "success");
		    $form->setValues(array(),true);
		}
		catch (Nette\Security\AuthenticationException $vyjimka){
		    $form->addError($vyjimka->getMessage());
		}
	    }
	    else {
		$form->addError("Odeslány neplatné údaje");
		$this->invalidateControl("signUpForm");
	    }
	    
	    
	}*/

	
	public function actionOut()
	{
		$this->getUser()->logout(true);
		$this->flashMessage('Odhlášení proběhlo úspěšně. Brzy zase Annyeong! ^^','success');
		$this->redirect('in');
	}
	
	public function actionIn() {
	    //Pokud je uživatel přihlášen, přesměrujeme ho na hlavní stránku
	    $this->template->smsel = 1;
	    if ($this->getUser()->isLoggedIn())
		$this->redirect ("homepage:default");
	    $this->invalidateControl("prihlasit");
	}
	
	/*public function actionUp() {
	    //Pokud je uživatel přihlášen, přesměrujeme ho na hlavní stránku
	    $this->template->smsel = 2;
	    if ($this->getUser()->isLoggedIn())
		$this->redirect ("homepage:default");
	     $this->invalidateControl("registrovat");
	}*/
	
	public function  actionRules() {
	    $this->template->smsel = 3;
	}

}
