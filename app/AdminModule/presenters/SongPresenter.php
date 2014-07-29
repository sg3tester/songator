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

class SongPresenter extends BasePresenter{

	/** @var  \App\Model\ZanrRepository @inject */
	public $zanry;

	protected function createComponentSongList($name)
	{
		$grid = new Grid($this, $name);
		$grid->setModel($this->songy->findAll());

		$grid->addColumnDate("datum", "Datum", "d.m.y")
			->setSortable()
			->setFilterDateRange();
		$grid->addColumnText("interpret_name", "Interpret")
			->setCustomRender(function($item){
				return $item->interpret_name . ($item->interpret ? " " . Html::el('i')->addAttributes(['class' => 'fa fa-ticket', 'title' => 'Asociován s '.$item->interpret->nazev]) : null);
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
			->setCustomRender(function($item){
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
			->setCustomRender(function($item){
				$status = $item->status;

				$revizor = $item->revisor ? $item->ref("user","revisor")->username : "neznámý";
				switch ($status) {
					case "approved":
						return Html::el("span",array(
							"class" => "label label-success",
							"title" => "Schválil(a) ". $revizor
						))
							->setText("Zařazen");
					case "waiting":
						return Html::el("span",array(
							"class" => "label label-warning",
							"title" => "Čeká ve frontě ke schválení"
						))
							->setText("Čeká");
					case "rejected":
						return Html::el("span",array(
							"class" => "label label-danger",
							"title" => "Zamítl(a) ". $revizor
						))
							->setText("Vyřazen");
					default:
						return Html::el("i")
							->setText("Neznámý");
				}
			})
			->setSortable()
			->setFilterSelect($statuses);

		$grid->addColumnText("pecka","Pecka")->setReplacement(array(
			0 => '',
			1 => Html::el('i')->addAttributes(['class' => 'fa fa-check'])
		))->setFilterCheck()->setCondition(" = 1");

		$grid->addColumnText("instro","Instro")->setReplacement(array(
			0 => '',
			1 => Html::el('i')->addAttributes(['class' => 'fa fa-check'])
		))->setFilterCheck()->setCondition(" = 1");

		$grid->addColumnText("remix","Remix")->setReplacement(array(
			0 => '',
			1 => Html::el('i')->addAttributes(['class' => 'fa fa-check'])
		))->setFilterCheck()->setCondition(" = 1");

		$grid->addColumnNumber("likes",Html::el('i')->addAttributes(['class' => 'fa fa-heart']))->setCustomRender(function($item){
			return $item->related("song_likes")->count();
		});

		$grid->addActionHref("edit","Editovat")
				->setIcon("pencil");

		$grid->setFilterRenderType(Filter::RENDER_OUTER);

		$grid->setDefaultSort(array("datum" => "DESC"));

		//Set face for grid
		$gridTemplate = __DIR__ . "/../templates/components/Grid.latte";
		if (file_exists($gridTemplate))
			$grid->setTemplateFile($gridTemplate);

		return $grid;
	}
} 