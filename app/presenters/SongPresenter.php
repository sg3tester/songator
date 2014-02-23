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
	
	/** @var \App\Model\InterpretRepository @inject */
	public $interpreti;

	/** @var \App\Model\ZanrRepository @inject */
	public $zanry;
	
	protected $songy;

	public function actionList($status) {
	
		if ($status) 
			$this->songy = $this->songList->findByStatus($status);
		else
			$this->songy = $this->songList->findAll();
		
		$this->template->summary = $this->songList->getSummary();
		$this->template->status = $status;
	}


	/************************** Approve/Reject ********************************/
	
	public function actionReject($id) {
		if ($this->isAjax())
			$this->setLayout(false);
		$song = $this->songList->find($id);
		$this["reject"]->SetDefaults($song);
		$this->template->song = $song;
	}
	
	public function actionApprove($id) {
		if ($this->isAjax())
			$this->setLayout(false);
		$song = $this->songList->find($id);
		$this["approve"]->SetDefaults($song);
		$this->template->song = $song;
	}
	
	/***************************** Bindings ***********************************/
	
	public function actionBindInterpret($term) {
		$complete = $this->interpreti->bind($term, false);
		
		$this->sendJson($complete);
	}


	/****************************** Add song **********************************/
	
	protected function createComponentAddSong() {
		$form = new Form();
		
		$form->addText("interpret", "Interpret")
				->setRequired();
		$form->addText("name", "Song");
		$form->addSelect("zanr", "Žánr", $this->zanry->getList());
		$form->addText("link", "Link k poslechnutí");
		
		//This field only if user is NOT logged in
		if (!$this->user->isLoggedIn())
			$form->addText("zadatel", "Žadatel")
				->setRequired("Musíte zadat svou přezdívku!");
		
		$form->addCheckbox("remix","Tento song je remix!");
		$form->addCheckbox("terms","Souhlasím s podmínkami")
				->setRequired("Musíte souhlasit s podmínkami");
		
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
			"interpret_name" => $val->interpret,
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
		
		$msg = $this->flashMessage("Song byl úspěšně přidán", "success");
		$msg->title = "Yeah!";
		$this->redirect("this");
	}
	
	////////////////////////////////////////////////////////////////////////////
	
	/****************************** Song list *********************************/

	protected function createComponentSongList($name)
	{
		$grid = new Grido\Grid($this, $name);
		$grid->setModel($this->songy);
		
		$grid->addColumnDate("datum", "Datum", "d.m.y")
				->setSortable();
		$grid->addColumnText("interpret_name", "Interpret")
				->setCustomRender(function($item){
					$template = $this->createTemplate();
					$template->setFile(__DIR__ . "/../templates/components/Grid/interpret.latte");
					$template->song = $item;
					return $template;
				})
				->setSortable()
				->setFilterText()
				->setSuggestion();
		
		$grid->addColumnText("name", "Song")
				->setCustomRender(function($item){
					$template = $this->createTemplate();
					$template->setFile(__DIR__ . "/../templates/components/Grid/song.latte");
					$template->song = $item;
					return $template;
				})
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
					
					switch ($status) {
						case "approved":
							return Html::el("span",array("class" => "label label-success"))
								->setText("Zařazen");
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
				})
				->setSortable()
				->setFilterSelect($statuses);
		
		$grid->addColumnText("vzkaz", "Vzkaz DJovi");
		
		$grid->addActionHref("approve", "")
				->setIcon("ok")
				->setElementPrototype(Html::el("a",array(
					"class" => "btn btn-success",
					"data-toggle" => "modal",
					"data-target" => ".modal"
					)));
		
		$grid->addActionHref("reject", "")
				->setIcon("remove")
				->setElementPrototype(Html::el("a",array(
					"class" => "btn btn-danger",
					"data-toggle" => "modal",
					"data-target" => ".modal"
					)));
		
		$grid->addActionHref("play", "")
				->setIcon("play")
				->setElementPrototype(Html::el("a",array("class" => "btn btn-info", "target" => "blank")));
		
		$grid->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_OUTER);
		$grid->setDefaultSort(array("datum" => "DESC"));
		
		//Set face for grid
		$gridTemplate = __DIR__ . "/../templates/components/Grid.latte";
		if (file_exists($gridTemplate))
			$grid->setTemplateFile($gridTemplate);
		
		return $grid;
	}
	
	////////////////////////////////////////////////////////////////////////////
	/************************* Song approve ***********************************/
	
	protected function createComponentApprove() {
		$form = new Form();
		
		$form->addCheckbox("remix");
		$form->addCheckbox("pecka");
		$form->addCheckbox("instro");
		$form->addTextArea("note");
		$form->addHidden("id");
		
		$form->addSubmit("approve");
		
		$form->onSuccess[] = $this->approveSuccess;
		
		return $form;
	}
	
	public function approveSuccess(Form $form) {
		$val = $form->getValues();
		
		//Mapping additional data
		$additional = array(
			"remix" => $val->remix,
			"instro" => $val->instro,
			"pecka" => $val->pecka
		);
		
		$this->songList->approve($val->id, $this->user->getId(), $val->note, $additional);
		
		$msg = $this->flashMessage("Song schválen a zařazen do playlistu", "success");
		$msg->title = "A je tam!";
		$this->redirect("list");
	}
	
	////////////////////////////////////////////////////////////////////////////
	/************************* Song reject ***********************************/
	
	protected function createComponentReject() {
		$form = new Form();
		
		$form->addTextArea("note")
				->setRequired("Musíte udat důvod zamítnutí!");
		$form->addHidden("id");
		
		$form->addSubmit("reject");
		
		$form->onSuccess[] = $this->rejectSuccess;
		
		return $form;
	}
	
	public function rejectSuccess(Form $form) {
		$val = $form->getValues();
		
		$this->songList->reject($val->id, $this->user->getId(), $val->note);
		
		$msg = $this->flashMessage("Song zamítnut a vyřazen z playlistu", "success");
		$msg->title = "A je ze hry!";
		$this->redirect("list");
	}

}
