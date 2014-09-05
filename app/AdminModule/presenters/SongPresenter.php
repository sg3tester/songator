<?php

/**
 * Created by PhpStorm.
 * User: JDC
 * Date: 26.7.2014
 * Time: 20:07
 */

namespace App\AdminModule\Presenters;

use App\Model\ZanrRepository;
use Grido\Components\Filters\Filter;
use Grido\Grid;
use Nette\Utils\Html;
use Nette\Application\UI\Form;

class SongPresenter extends BasePresenter {

	/** @var  \App\Model\ZanrRepository @inject */
	public $zanry;

	public function actionGenre($id) {
		if ($id) {
			$genre = $this->zanry->find($id);
			if ($genre) {
				$this['genreEditor']->setDefaults(genre);
				$this['genreEditor']['send']->caption = 'Upravit';
				$this->template->isEdit = true;
			}
		}
	}

	public function handleDeleteGenre($id) {
		$genre = $this->zanry->find($id);
		if (!$genre) {
			$msg = $this->flashMessage("Tenhle žánr neexistuje.", 'danger');
			$msg->title = 'Oh shit!';
			$msg->icon = 'warning';
			$this->redirect('this', null);
		}
		try {
			$genre->delete();
			$msg = $this->flashMessage("Žánr '$genre->name' úspěšně smazán.", 'success');
			$msg->title = 'Yehet!';
			$msg->icon = 'check';
		} catch (\PDOException $ex) {
			$msg = $this->flashMessage("Něco se podělalo. Zkuzte to prosím později.", 'danger');
			$msg->title = 'Oh shit!';
			$msg->icon = 'warning';
		}
		$this->redirect('this', null);
	}

	protected function createComponentSongList($name) {
		$grid = new Grid($this, $name);
		$grid->setModel($this->songy->findAll());

		$grid->addColumnDate("datum", "Datum", "d.m.y")
				->setSortable()
				->setFilterDateRange();
		$grid->addColumnText("interpret_name", "Interpret")
				->setCustomRender(function($item) {
					return $item->interpret_name . ($item->interpret ? " " . Html::el('i')->addAttributes(['class' => 'fa fa-ticket', 'title' => 'Asociován s ' . $item->interpret->nazev]) : null);
				})
				->setSortable()
				->setFilterText()
				->setSuggestion();

		$grid->addColumnText("name", "Song")
				->setSortable()
				->setFilterText()
				->setSuggestion();

		$filter = array('' => 'Všechny');
		$filter = \Nette\Utils\Arrays::mergeTree($filter, $this->zanry->getList());
		$grid->addColumnText("zanr_id", "Žánr")
				->setCustomRender(function($item) {
					return $item->zanr ? $item->zanr->name : null;
				})
				->setFilterSelect($filter);

		$grid->addColumnText("zadatel", "Přidal(a)")
				->setSortable()
				->setFilterText()
				->setSuggestion();

		$statuses = array(
			'' => 'Všechny',
			'approved' => 'Zařazené',
			'rejected' => 'Vyřazené',
			'waiting' => 'Čekající'
		);
		$grid->addColumnText("status", "Status")
				->setCustomRender(function($item) {
					$status = $item->status;

					$revizor = $item->revisor ? $item->ref("user", "revisor")->username : "neznámý";
					switch ($status) {
						case "approved":
							return Html::el("span", array(
										"class" => "label label-success",
										"title" => "Schválil(a) " . $revizor
									))
									->setText("Zařazen");
						case "waiting":
							return Html::el("span", array(
										"class" => "label label-warning",
										"title" => "Čeká ve frontě ke schválení"
									))
									->setText("Čeká");
						case "rejected":
							return Html::el("span", array(
										"class" => "label label-danger",
										"title" => "Zamítl(a) " . $revizor
									))
									->setText("Vyřazen");
						default:
							return Html::el("i")
									->setText("Neznámý");
					}
				})
				->setSortable()
				->setFilterSelect($statuses);

		$grid->addColumnText("pecka", "Pecka")->setReplacement(array(
			0 => '',
			1 => Html::el('i')->addAttributes(['class' => 'fa fa-check'])
		))->setFilterCheck()->setCondition(" = 1");

		$grid->addColumnText("instro", "Instro")->setReplacement(array(
			0 => '',
			1 => Html::el('i')->addAttributes(['class' => 'fa fa-check'])
		))->setFilterCheck()->setCondition(" = 1");

		$grid->addColumnText("remix", "Remix")->setReplacement(array(
			0 => '',
			1 => Html::el('i')->addAttributes(['class' => 'fa fa-check'])
		))->setFilterCheck()->setCondition(" = 1");

		$grid->addColumnNumber("likes", Html::el('i')->addAttributes(['class' => 'fa fa-heart']))->setCustomRender(function($item) {
			return $item->related("song_likes")->count();
		});

		$grid->addActionHref("edit", "Editovat")
				->setIcon("pencil");

		$grid->setFilterRenderType(Filter::RENDER_OUTER);

		$grid->setDefaultSort(array("datum" => "DESC"));

		//Set face for grid
		$gridTemplate = __DIR__ . "/../templates/components/Grid.latte";
		if (file_exists($gridTemplate))
			$grid->setTemplateFile($gridTemplate);

		return $grid;
	}

	protected function createComponentGenres() {
		$grid = new Grid();

		$grid->setModel($this->zanry->findAll());

		$grid->addColumnText('name', 'Žánr')
				->setSortable();

		$grid->addColumnText('popis', 'Krátký popis');

		$grid->addActionHref('genre', 'Upravit')
				->setIcon('pencil');
		$grid->addActionHref('remove', 'Smazat', 'deleteGenre!')
				->setConfirm("Opravdu chcete smazat tento žánr?")
				->setIcon('trash');

		return $grid;
	}

	protected function createComponentGenreEditor() {
		$form = new Form();

		$form->addText('name', 'Žánr')
				->setRequired("Zadejte název žánru");
		$form->addText('popis', 'Krátký popis');
		$form->addHidden('id');
		$form->addSubmit('send', 'Přidat');

		$form->onSuccess[] = function(Form $frm) {
			$values = $frm->values;

			if ($values->id) {
				$this->zanry->find($values->id)->update($values);
				$msg = $this->flashMessage("Žánr '$values->name' editován.", 'success');
				$msg->title = 'A je tam!';
				$msg->icon = 'check';
			} else {
				$this->zanry->add($values);
				$msg = $this->flashMessage("Žánr '$values->name' přidán.", 'success');
				$msg->title = 'A je tam!';
				$msg->icon = 'check';
			}

			$this->redirect('this');
		};

		return $form;
	}

}
