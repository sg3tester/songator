<?php

namespace App\Presenters;

use Nette,
	Grido,
	\Nette\Utils\Html,
	\Nette\Application\UI\Form,
	App\Model;


/**
 * Song presenter.
 */
class SongPresenter extends BasePresenter
{
	/** @var \App\Model\SongRepository @inject */
	public $songList;

	public function actionAdd() {
		
	}
	
	protected function createComponentAddSong() {
		$form = new Form();
		
		$form->addText("interpret", "Interpret")
				->setRequired();
		$form->addText("name", "Song");
		$form->addSelect("zanr", "Žánr", array("lol","sdfgd","erter"));
		$form->addText("link", "Link k poslechnutí");
		$form->addText("zadatel", "Žadatel");
		
		$form->addCheckbox("remix","Tento song je remix!");
		$form->addCheckbox("terms","Souhlasím s podmínkami");
		
		$form->addSubmit("add");
		
		$form->setRenderer(new \Nextras\Forms\Rendering\Bs3FormRenderer());
		
		$form->onSuccess[] = $this->addSongSuccess;
		
		return $form;
	}
	
	public function addSongSuccess(Form $form) {
		$val = $form->getValues();
		
		//Fill main data
		$data = array(
			"name" => $val->name,
			"interpret" => $val->interpret,
			"zanr_id" => $val->zanr,
			"link" => $val->link,
			"remix" => $val->remix
		);
		
		//Add user information
		if ($this->user->isLoggedIn()) {
			$data["zadatel"] = $this->user->getIdentity()->username;
			$data["user_id"] = $this->user->getId();
		}
		else 
			$data["zadatel"] = $val->zadatel;
		
		$this->songList->add($data);
		
		$this->flashMessage("Song byl přidán", "success");
		$this->redirect("this");
	}

	protected function createComponentSongList($name)
	{
		$grid = new Grido\Grid($this, $name);
		$grid->setModel($this->songList->findAll());
		
		$grid->addColumnDate("datum", "Datum", "d.m.y")
				->setSortable();
		$grid->addColumnText("interpret", "Interpret")
				->setSortable()
				->setFilterText()
				->setSuggestion();
		
		$grid->addColumnText("name", "Song")
				->setSortable()
				->setFilterText()
				->setSuggestion();
		
		$grid->addColumnText("zanr", "Žánr")
				->setColumn(function($item){
					return $item->zanr ? $item->zanr->name : null;
				});
		
		$grid->addColumnText("zadatel", "Přidal(a)")
				->setSortable()
				->setFilterText()
				->setSuggestion();
		
		$grid->addColumnText("status", "Status")
				->setCustomRender(function($item){
					$status = $item->status;
					
					switch ($status) {
						case "approved":
							return Html::el("span",array("class" => "label label-success"))
								->setText("Schválen");
						case "waiting":
							return Html::el("span",array("class" => "label label-warning"))
								->setText("Čeká");
						case "rejected":
							return Html::el("span",array("class" => "label label-danger"))
								->setText("Vyřazen");
						default:
							return Html::el("i")
								->setText("Neznámý");
					}
				});
		
		$grid->addColumnText("vzkaz", "Vzkaz DJovi");
		
		$grid->addActionHref("approve", "")
				->setIcon("ok")
				->setElementPrototype(Html::el("a",array("class" => "btn btn-success")));
		
		$grid->addActionHref("reject", "")
				->setIcon("remove")
				->setElementPrototype(Html::el("a",array("class" => "btn btn-danger")));
		
		$grid->addActionHref("play", "")
				->setIcon("play")
				->setElementPrototype(Html::el("a",array("class" => "btn btn-info", "target" => "blank")));
		
		$grid->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_OUTER);
		
		$grid->setTemplateFile(__DIR__ . "/../templates/components/Grid.latte");
		
		return $grid;
	}

}
