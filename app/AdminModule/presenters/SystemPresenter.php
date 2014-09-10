<?php

namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;

/**
 * Description of SystemPresenter
 *
 * @author JDC
 */
class SystemPresenter extends BasePresenter {

	/** @var \Settings @inject */
	public $settings;

	public function renderExpert() {
		$this->template->settings = $this->settings->getList();
	}

	public function handleClear($key) {
		$this->settings->clear($key);
		$this->settings->push();
		$msg = $this->flashMessage("Nastavení '$key' bylo vymazáno.", 'success');
		$msg->title = 'Yehet!';
		$msg->icon = 'check';
		$this->redirect('this');
	}

	protected function createComponentSettings() {
		$form = new Form();

		$form->addSubmit('save', 'Zapsat změny');

		$form->onSuccess[] = function(Form $f) {
			$values = $f->getHttpData();
		};

		return $form;
	}

}
