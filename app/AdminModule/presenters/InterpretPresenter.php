<?php

/**
 * Created by PhpStorm.
 * User: JDC
 * Date: 26.7.2014
 * Time: 20:07
 */

namespace App\AdminModule\Presenters;

use Grido\Components\Filters\Filter;
use Grido\Grid;
use Nette\Utils\Html;
use Nette\Application\UI\Form;
use \Nette\Utils\Strings;

class InterpretPresenter extends BasePresenter {

	/** @var \App\Model\InterpretRepository @inject */
	public $interpreti;

	/** @var App\Model\Lastfm\Lastfm @inject */
	public $lastfm;

	public function actionEditor($id = null) {
		if ($id) {
			$interpret = $this->interpreti->find($id);
			$this['addInterpret']->setDefaults($interpret);
			$this['addInterpret']['send']->caption = 'Upravit';
			$this->template->isEdit = true;
			$this->template->interpret = $interpret;
			$this->template->lastfm = $this->lastfm->call('Artist.getInfo', ['artist' => $interpret->nazev])->artist;
		}
	}

	public function actionAssoc() {
		$interpreti = $this->songy->findAll()->select('interpret_name, COUNT(id) AS amount')->where('interpret_id IS NULL')->group('interpret_name');
		$this->template->interpreti = $interpreti;
		$this->template->registry = $this->interpreti->findAll();
	}

	protected function createComponentInterpretList($name) {
		$grid = new Grid($this, $name);
		$grid->setModel($this->interpreti->findAll());

		$grid->addColumnText("nazev", "Interpret")
				->setCustomRender(function($item) {
					return !$item->interpret_id ? Html::el('b')->setText($item->nazev) : $item->nazev;
				})
				->setSortable()
				->setFilterText()
				->setSuggestion();

		$grid->addColumnText("alias", "Alias pro")
				->setColumn(function($item) {
					return isset($item->interpret->nazev) ? $item->interpret->nazev : null;
				});

		$grid->addFilterCheck('interpret_id', 'Jen aliasy');

		$grid->addColumnText("desc", "Popis")->setCustomRender(function($item){
			return Strings::truncate($item->desc, 256);
		});

		$grid->addActionHref('edit', 'Editovat', 'editor')
				->setIcon('pencil');

		$grid->addActionHref('delete', 'Smazat', 'delete!')
				->setIcon('trash')
				->setConfirm('Opravdu chcete smazat tohoto interpreta?');

		//Set face for grid
		$gridTemplate = __DIR__ . "/../templates/components/Grid.latte";
		if (file_exists($gridTemplate))
			$grid->setTemplateFile($gridTemplate);

		return $grid;
	}

	protected function createComponentAddInterpret() {
		$form = new Form();

		$form->addText('nazev', 'Název interpreta')
				->setRequired('Je třeba zadat jméno interpreta.');

		$form->addSelect('interpret_id', 'Alias pro', $this->interpreti->findAll()->order('nazev')->fetchPairs('id', 'nazev'))
				->setPrompt('Vyberte alias');

		$form->addTextArea('desc', 'About');

		$form->addHidden('id');

		$form->addSubmit('send', 'Přidat');

		$form->onSuccess[] = function($frm) {
			$values = $frm->values;
			if ($values->id) {
				$this->interpreti->find($values->id)->update($values);
				$msg = $this->flashMessage("Interpret '$values->nazev' editován.", 'success');
				$msg->title = 'A je tam!';
				$msg->icon = 'check';
			} else {
				$r = $this->interpreti->add($values->nazev, $values->desc, $values->interpret_id, $this->user);
				$msg = $this->flashMessage("Interpret '$values->nazev' přidán.", 'success');
				$msg->title = 'A je tam!';
				$msg->icon = 'check';
				$msg->html = Html::el('a')->setText('Přidat další')->setHref($this->link('editor'));
				if ($this->action == 'editor')
					$this->redirect('this', [$r->id]);
			}
			$this->redirect('this');
		};

		return $form;
	}

	public function handleDelete($id) {
		try {
			$interpret = $this->interpreti->find($id);
			if (!$interpret)
				throw new \PDOException("Row #$id not exists!");

			$name = $interpret->nazev;
			$interpret->delete();
			$msg = $this->flashMessage("Interpret '$name' smazán", 'success');
			$msg->title = 'A je venku!';
			$msg->icon = 'trash-o';
		} catch (\PDOException $e) {
			$msg = $this->flashMessage("Interpreta se nepodařilo odstranit", 'danger');
			$msg->title = 'Oh shit!';
			$msg->icon = 'exclamation-triangle';
			\Nette\Diagnostics\Debugger::log($e, \Nette\Diagnostics\Debugger::ERROR);
		}

		$this->redirect('this');
	}

	protected function createComponentAssociator() {
		$form = new Form();

		$form->addSubmit('make', 'Proveď');

		$form->onSuccess[] = function (Form $frm) {
			$data = $frm->getHttpData(Form::DATA_TEXT);
			
			$created = 0;
			if(isset($data['create'])) {
				foreach ($data['create'] as $toCreate => $on) {
					$r = $this->interpreti->add($toCreate, '', null, $this->user);
					$data['assoc'][$toCreate] = $r->id;
					$created++;
				}
			}
			
			$this->songy->beginTransaction();
			$count = 0;
			foreach ($data['assoc'] as $key => $value) {
				if ($value) {
					$this->songy->findBy(['interpret_name' => $key])
							->where('interpret_id IS NULL')
							->update(['interpret_id' => $value]);
					$count++;
				}
			}
			if (!$count) {
				$msg = $this->flashMessage("V seznamu níže vyberte interprety, které chcete asociovat s registrem a ze seznamu položek daného interpreta určete, "
						. "se kterým interpretem v registru má být asociován, nebo zaškrtněte možnost 'vytvořit' pro přidání "
						. "interpreta do registru a jeho následnou asociaci.", 'info');
				$msg->title = 'Vyberte interprety k asociaci';
				$msg->icon = 'ticket';
				$this->redirect('this');
			}
			$this->songy->commit();
			$msg = $this->flashMessage("$count interpretů bylo úspěšně asiciováno s registrem. ($created vytvořeno)", 'success');
			$msg->title = 'Oh yeah!';
			$msg->icon = 'check';
			$this->redirect('this');
		};

		return $form;
	}

}
