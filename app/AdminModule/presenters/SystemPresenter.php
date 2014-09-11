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

			try {
				if (isset($values['setting'])) {
					foreach ($values['setting'] as $key => $value) {
						$this->settings->set($key, $value);
					}
				}
				if (isset($values['clear'])) {
					foreach ($values['clear'] as $key => $value) {
						$this->settings->clear($key);
					}
				}

				$this->settings->push(); //Write
				$this->logger->log('System', 'edit', "%user% změnila(a) nastavení");
				$msg = $this->flashMessage("Všechny změny byly uloženy", 'success');
				$msg->title = 'Yehet!';
				$msg->icon = 'check';
				$this->redirect('this');
			} catch (\PDOException $e) {
				\Nette\Diagnostics\Debugger::log($e);
				$msg = $this->flashMessage("Něco se podělalo. Zkuste to prosím později.", 'danger');
				$msg->title = 'Oh shit!';
				$msg->icon = 'warning';
			}
		};

		return $form;
	}

	protected function createComponentAddSetting() {
		$form = new Form();

		$form->addText('key', 'Klíč')
				->setRequired('Zadejte klíč nastavení');

		$form->addText('value', 'Hodnota')
				->setRequired('Zadejte hodnotu nastavení');

		$form->addSubmit('send', 'Zapsat');

		$form->onSuccess[] = function (Form $f) {
			try {
				$val = $f->values;
				$this->settings->set($val->key, $val->value);
				$this->settings->push(); //Write
				$this->logger->log('System', 'edit', "%user% změnila(a) nastavení");
				$msg = $this->flashMessage("Nastavení bylo zapsáno", 'success');
				$msg->title = 'Yehet!';
				$msg->icon = 'check';
				$this->redirect('this');
			} catch (\PDOException $e) {
				\Nette\Diagnostics\Debugger::log($e);
				$msg = $this->flashMessage("Něco se podělalo. Zkuste to prosím později.", 'danger');
				$msg->title = 'Oh shit!';
				$msg->icon = 'warning';
			}
		};

		return $form;
	}

}
