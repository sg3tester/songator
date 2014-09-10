<?php

namespace App\AdminModule\Presenters;
use Grido\Grid;
use Nette\Application\UI\Form;

/**
 * Description of CmsPresenter
 *
 * @author JDC
 */
class CmsPresenter extends BasePresenter {
	
	/** @var \App\Model\ContentRepository @inject */
	public $pages;
	
	protected function createComponentPages() {
		$grid = new Grid();

		$grid->setModel($this->pages->findAll());

		$grid->addColumnText('name', 'Název stránky (Target/SEO)')
				->setSortable();

		$grid->addColumnText('heading', 'Nadpis')
				->setSortable();
		
		$grid->addColumnText('hidden', 'Útržek')
				->setSortable();

		$grid->addActionHref('editor', 'Upravit')
				->setIcon('pencil');
		$grid->addActionHref('remove', 'Smazat', 'delete!')
				->setConfirm("Opravdu chcete smazat tuto stránku?")
				->setIcon('trash');

		return $grid;
	}
	
	protected function createComponentPageEditor() {
		$form = new Form();
		
		$form->addText('name', 'Název stránky')
				->setRequired();
		$form->addText('heading', 'Nadpis')
				->setRequired();
		$form->addTextArea('body', 'Obsah');
		$form->addCheckbox('hidden', 'Výstřižek stránky');
		$form->addHidden('id');
		
		$form->addSubmit('send', 'Uložit');
		
		$form->onSuccess[] = function (Form $f) {
			$val = $f->values;
			
			//Update page
			if ($val->id) {
				$this->pages->find($val->id)->update($val);
				$msg = $this->flashMessage("Stránka byla upravena", 'success');
				$msg->title = 'A je tam!';
				$msg->icon = 'check';
			}
			else {
				$r = $this->pages->create($val);
				$msg = $this->flashMessage("Stránka byla vytvořena.", 'success');
				$msg->title = 'A je tam!';
				$msg->icon = 'check';
				$this->redirect('this',['id' => $r->id]);
			}
			$this->redirect('this');
			
		};
		
		return $form;
	}
	
	public function actionEditor($id) {
		if ($id) {
			$r = $this->pages->find($id);
			if (!$r)
				$this->redirect ('list');
			
			$this['pageEditor']->setDefaults($r);
		}
	}
	
	public function handleDelete($id) {
		try {
			$page = $this->pages->find($id);
			if (!$page)
				throw new \PDOException("Row #$id not exists!");

			$page->delete();
			$msg = $this->flashMessage("Stránka smazána", 'success');
			$msg->title = 'A je venku!';
			$msg->icon = 'trash-o';
		} catch (\PDOException $e) {
			$msg = $this->flashMessage("Někde nastala chyba.", 'danger');
			$msg->title = 'Oh shit!';
			$msg->icon = 'exclamation-triangle';
			\Nette\Diagnostics\Debugger::log($e, \Nette\Diagnostics\Debugger::ERROR);
		}

		$this->redirect('this');
	}
}
