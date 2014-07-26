<?php
/**
 * Created by PhpStorm.
 * User: JDC
 * Date: 26.7.2014
 * Time: 20:07
 */

namespace App\AdminModule\Presenters;


use App\Model\ZanrRepository;
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
			->setSortable();
		$grid->addColumnText("interpret_name", "Interpret")
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

		$grid->addColumnText("vzkaz", "Vzkaz DJovi")
			->setCustomRender(function($item){
				$elm = Html::el("span");
				if ($item->private_vzkaz) {
					if (!$this->user->isAllowed("privateMsg", "view") && $this->user->id != $item->user_id) {
						$elm->addAttributes(array("class" => "msg-hidden", "title" => "Tento vzkaz je určen pouze pro DJe"));
						$elm->setText("Soukromý vzkaz");
						return $elm;
					}
					$elm->addAttributes(array("class" => "msg-private", "title" => "Tento vzkaz je určen pouze pro DJe"));
					$elm->setText($item->vzkaz);
				}
				else
					return $item->vzkaz;
				return $elm;
			});

		if ($this->user->isAllowed("song","approve"))
			$grid->addActionHref("approve", "")
				->setIcon("ok")
				->setElementPrototype(Html::el("a",array(
					"class" => "btn btn-success",
					"data-toggle" => "modal",
					"data-target" => ".modal"
				)));

		if ($this->user->isAllowed("song","reject"))
			$grid->addActionHref("reject", "")
				->setIcon("remove")
				->setElementPrototype(Html::el("a",array(
					"class" => "btn btn-danger",
					"data-toggle" => "modal",
					"data-target" => ".modal"
				)));

		if ($this->user->isAllowed("song","play"))
			$grid->addActionHref("play", "")
				->setDisable(function($item){
					if ($item->link)
						return false;
					return true;
				})
				->setIcon("play")
				->setElementPrototype(Html::el("a",array(
					"class" => "btn btn-info",
					"data-toggle" => "modal",
					"data-target" => ".modal"
				)));

		$grid->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_OUTER);
		$grid->setDefaultSort(array("datum" => "DESC"));

		//Set face for grid
		$gridTemplate = __DIR__ . "/../templates/components/Grid.latte";
		if (file_exists($gridTemplate))
			$grid->setTemplateFile($gridTemplate);

		return $grid;
	}
} 