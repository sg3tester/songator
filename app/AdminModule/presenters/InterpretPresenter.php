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

class InterpretPresenter extends BasePresenter {

	/** @var \App\Model\InterpretRepository @inject */
	public $interpreti;

	protected function createComponentInterpretList($name) {
		$grid = new Grid($this, $name);
		$grid->setModel($this->interpreti->findAll());

		$grid->addColumnText("nazev", "Interpret")
				->setCustomRender(function($item){
					return !$item->interpret_id ? Html::el('b')->setText($item->nazev) : $item->nazev;
				})
				->setFilterText();

		$grid->addColumnText("alias", "Alias pro")
				->setColumn(function($item) {
					return isset($item->interpret->nazev) ? $item->interpret->nazev : null;
				});

		$grid->addFilterCheck('interpret_id', 'Jen aliasy');

		$grid->addColumnText("desc", "Popis");
		
		$grid->addActionHref('edit', 'Editovat', 'edit')
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
		
		$form->addSubmit('send', 'Přidat');
		
		$form->onSuccess[] = function($frm) {
			$values = $frm->values;
			$this->interpreti->add($values->nazev, $values->desc, $values->interpret_id, $this->user);
			$msg = $this->flashMessage("Interpret '$values->nazev' přidán", 'success');
			$msg->title = 'A je tam!';
			$msg->icon = 'check';
			$this->redirect('this');
		};
		
		return $form;
		
	}
}
