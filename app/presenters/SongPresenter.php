<?php

namespace App\Presenters;

use Nette,
	Grido,
	\Nette\Utils\Html,
	App\Model;


/**
 * Song presenter.
 */
class SongPresenter extends BasePresenter
{
	/** @var \App\Model\SongRepository @inject */
	public $songList;

	public function actionDefault() {
		
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
