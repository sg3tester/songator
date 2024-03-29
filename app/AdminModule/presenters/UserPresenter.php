<?php

namespace App\AdminModule\Presenters;

use Grido\Grid;
use Nette\Application\UI\Form;

/**
 * Description of UserPresenter
 *
 * @author JDC
 */
class UserPresenter extends BasePresenter {

	/** @var \App\UserManager @inject */
	public $users;

	/** @var \App\Model\Permissions @inject */
	public $perms;

	public function actionEditor($id) {
		if (!$id)
			$this->redirect('create');

		$user = $this->users->getUser($id);

		if (!$user)
			$this->redirect('list');

		$this['userEditor']->setDefaults($user);
		$this->template->profile = $user;
	}

	public function handleDelete($id) {
		$user = $this->users->getUser($id);
		if (!$user) {
			$msg = $this->flashMessage("Tenhle uživatel neexistuje.", 'danger');
			$msg->title = 'Oh shit!';
			$msg->icon = 'warning';
			$this->redirect('this');
		}
		try {
			$user->delete();
			$this->logger->log('User', 'delete', "%user% smazala(a) uživatele {$user->username}");
			$msg = $this->flashMessage("Uživatel '$user->username' úspěšně smazán.", 'success');
			$msg->title = 'Yehet!';
			$msg->icon = 'check';
		} catch (\PDOException $ex) {
			\Nette\Diagnostics\Debugger::log($ex);
			$msg = $this->flashMessage("Něco se podělalo. Zkuzte to prosím později.", 'danger');
			$msg->title = 'Oh shit!';
			$msg->icon = 'warning';
		}
		$this->redirect('this');
	}

	protected function createComponentUserList() {
		$grid = new Grid();

		$grid->setModel($this->users->getUsers());

		$grid->addColumnDate('registered', 'Registrován')
				->setSortable()
				->setFilterDateRange();

		$grid->addColumnText('username', 'Uživatelské jméno')
				->setSortable()
				->setFilterText()
				->setSuggestion();

		$grid->addColumnText('realname', 'Skutečné jméno')
				->setSortable()
				->setFilterText()
				->setSuggestion();

		$grid->addColumnMail('email', 'Email')
				->setSortable()
				->setFilterText()
				->setSuggestion();

		$roles = ['' => 'Vše'] + $this->perms->getRoles();
		$grid->addColumnText('role', 'Role')
				->setSortable()
				->setFilterSelect($roles);

		$grid->addColumnText('auth_service', 'Aut. služba')
				->setSortable()
				->setFilterSelect(['' => 'Vše', 'twitter' => 'Twitter', 'songator' => 'Songator']);

		$grid->addActionHref('editor', 'Upravit')
				->setIcon('pencil');

		$grid->addActionHref('selete', 'Smazat', 'delete!')
				->setConfirm('Opravdu smazat tohoto uživatele?')
				->setIcon('trash');

		return $grid;
	}

	protected function createComponentUserEditor() {
		$form = new Form();

		$form->addText('username', 'Uživatelské jméno')
				->setRequired('Zadejte uživatelské jméno');

		$form->addText('realname', 'Skutečné jméno');

		$form->addSelect('role', 'Role', $this->perms->getRoles())
				->setPrompt('Vyberte roli')
				->setRequired('Musíte vybrat roli uživatele');

		$form->addText('email', 'Email')
				->addCondition(Form::FILLED)
				->addRule(Form::EMAIL, 'Zadejte platnnou emailovou adresu');

		$form->addPassword('password', 'Heslo')
				->addCondition(Form::FILLED)
				->addRule(Form::MIN_LENGTH, 'Heslo musí mít minimálně %s znaků', 6);

		$form->addPassword('password_verify', 'Ověření hesla')
				->setOmitted()
				->addConditionOn($form['password'], Form::FILLED)
				->addRule(Form::EQUAL, 'Hesla se neshodují', $form['password']);

		$form->addText('twitter_acc', 'Twitter');

		$form->addText('www', 'Homepage (WWW)')
				->addCondition(Form::FILLED)
				->addRule(Form::URL, 'Zadejte platnou URL');

		$form->addTextArea('about', 'Krátce o uživateli');

		$form->addHidden('id')
				->setRequired('Vyžadován identifikátor');

		$form->onSuccess[] = function (Form $f) {
			$val = $f->values;
			if (empty($val->password))
				unset($val->password);
			else {
				$this->users->changePassword($val->id, $val->password);
				unset($val->password);
			}
			$this->users->update($val->id, $val);
			$this->logger->log('User', 'edit', "%user% editoval(a) profil uživatele {$val->username}");
			$msg = $this->flashMessage("Profil uživatele '$val->username' upraven.", 'success');
			$msg->title = 'A je tam!';
			$msg->icon = 'check';
			$this->redirect('this');
		};

		$form->addSubmit('send', 'Uložit');

		return $form;
	}

	protected function createComponentUserAdd() {
		$form = new Form();

		$form->addText('username', 'Uživatelské jméno')
				->setRequired('Zadejte uživatelské jméno');

		$form->addText('email', 'Email')
				->setRequired('Zadejte platnou emailovou adresu')
				->addRule(Form::EMAIL, 'Zadaná emailová adresa je neplatná');

		$form->addPassword('password', 'Heslo')
				->setRequired('Zadejte heslo')
				->addRule(Form::MIN_LENGTH, 'Heslo musí mít minimálně %s znaků', 6);

		$form->addPassword('password_verify', 'Ověření hesla')
				->setOmitted()
				->addConditionOn($form['password'], Form::FILLED)
				->addRule(Form::EQUAL, 'Hesla se neshodují', $form['password']);

		$form->addSubmit('send', 'Vytvořit účet');

		$form->onSuccess[] = function (Form $f) {
			try {
				$val = $f->values;
				$r = $this->users->add($val->username, $val->password, $val->email);
				$this->logger->log('User', 'edit', "%user% editoval(a) profil uživatele {$val->username}");
				$msg = $this->flashMessage("Profil uživatele '$val->username' upraven.", 'success');
				$msg->title = 'A je tam!';
				$msg->icon = 'check';
				$this->redirect('editor', [$r->id]);
			} catch (\App\UserManagerException $e) {
				$msg = $this->flashMessage($e->getMessage(), 'danger');
				$msg->title = 'Oh shit!';
				$msg->icon = 'warning';
			}
		};

		return $form;
	}

}
