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
class SongPresenter extends PrimePresenter
{
	/** @var \App\Model\SongRepository @inject */
	public $songList;

	/** @var \App\Model\InterpretRepository @inject */
	public $interpreti;

	/** @var \App\Model\ZanrRepository @inject */
	public $zanry;

	protected $songy;

	/** @var \Nette\Http\Url */
	private $playUrl;
	
	/** @persistent */
	public $back;

	public function actionList($status, $flags, $q) {

		if ($status)
			$this->songy = $this->songList->findByStatus($status);
		else
			$this->songy = $this->songList->findAll();
		
		//Simple song searching
		if($q) {
			$searcher = new \Searcher();
			$searcher->setModel($this->songy);
			$searcher->setMask("%?%");
			$searcher->setColumns(array("name","interpret_name"));
			$searcher->search($q);
			$this->template->q = $q;
		}
		
		//Filtering by flags
		if ($flags) {
			$this->setFilterDefaults($flags);
			$filter = new \FlagFilter();
			$filter->setModel($this->songy);
			$filter->setFlags(array(
				"r" => "remix",
				"i" => "instro",
				"p" => "pecka",
				"n" => array(
					"column" => "note",
					"by" => " != ''"
				)
			));
			$filter->filter($flags);
		}

		$this->template->summary = $this->songList->getSummary();
		$this->template->status = $status;
	}


	public function actionView($id) {
		$song = $this->songList->find($id);
		$this->playUrl = new \Nette\Http\Url($song->link);
		
		$this->template->song = $song;
	}

	public function renderAdd() {
		$rules = $this->settings->get("page_rules");
		if($rules) {
			try {
				$this->template->rules = $this->getPage($rules, true);
			}
			catch (Nette\Application\BadRequestException $e) {}
		}
	}

	/*********************** Approve/Reject & play ****************************/

	public function actionReject($id) {
		$this->checkPermissions("song", "reject");
		
		if ($this->isAjax())
			$this->setLayout(false);
		$song = $this->songList->find($id);
		$this["reject"]->SetDefaults($song);
		$this->template->song = $song;
	}

	public function actionApprove($id) {
		$this->checkPermissions("song", "approve");
		
		if ($this->isAjax())
			$this->setLayout(false);
		$song = $this->songList->find($id);
		$this["approve"]->SetDefaults($song);
		$this->template->song = $song;
	}

	public function actionPlay($id) {
		$this->checkPermissions("song", "play", false);
		
		if ($this->isAjax())
			$this->setLayout(false);
		$song = $this->songList->find($id);
		$this->template->song = $song;
		$this->playUrl = new \Nette\Http\Url($song->link);
	}


	/***************************** Bindings ***********************************/

	public function actionBindInterpret($term) {
		$complete = $this->interpreti->bind($term, false);

		$this->sendJson($complete);
	}

	public function actionMatchInterpret($match) {
		$this->sendJson($this->interpreti->match($match,10,0));
	}
	
	public function actionMatchSong($interpret, $song) {
		$this->sendJson($this->songList->match($interpret, $song));
	}

	/****************************** Add song **********************************/

	protected function createComponentAddSong() {
		$form = new Form();

		$form->addText("interpret", "Interpret")
				->setRequired("Musíte vyplnit jméno interpreta");
		$form->addText("name", "Song")
				->setRequired("Musíte zadat název songu");
		$form->addSelect("zanr", "Žánr", $this->zanry->getList())
				->setPrompt("Vyberte žánr")
				->setRequired("Není vybrán žádný platný žánr");
		$form->addText("link", "Link k poslechnutí");

		//This field only if user is NOT logged in
		if (!$this->user->isLoggedIn())
			$form->addText("zadatel", "Žadatel")
				->setRequired("Musíte zadat svou přezdívku!");

		$form->addCheckbox("private_vzkaz", "Označit vzkaz pro DJe jako soukromý");
		$form->addCheckbox("remix","Tento song je remix!");
		$form->addCheckbox("terms","Souhlasím s podmínkami")
				->setRequired("Musíte souhlasit s podmínkami");
		
		$form->addTextArea("vzkaz");

		$form->addSubmit("add");

		$form->setRenderer(new \Nextras\Forms\Rendering\Bs3FormRenderer());
	
		$form->onValidate[] = function ($form) {
			$val = $form->getValues();
			
			if ($val->private_vzkaz && !$this->user->isAllowed("privateMsg","add"))
					$form->addError("Nemáte oprávnění označit zprávu pro DJe jako soukromou!");
			
			if (($this->settings->get('songator_status', 'enabled') != 'enabled' || $this->settings->get('songator_wip', false))
					&& !$this->user->isAllowed("wip","switch"))
					$form->addError("Omlouváme se, Songator je dočasně vypnut. Nelze přidat song.");
		};
		$form->onSuccess[] = $this->addSongSuccess;

		return $form;
	}

	public function addSongSuccess(Form $form) {
		$val = $form->getValues();
		
		if (!$this->checkPermissions("song", "draft", FALSE))
			$this->redirect("add");

		//Fill main data
		$data = array(
			"name" => $val->name,
			"interpret_name" => $val->interpret,
			"zanr_id" => $val->zanr,
			"link" => $val->link,
			"remix" => $val->remix,
			"vzkaz" => $val->vzkaz,
			"private_vzkaz" => $val->private_vzkaz
		);
		
		if (!$this->user->isAllowed("privateMsg", "add"))
				$data["private_vzkaz"] = false;

		//Add user information
		if ($this->user->isLoggedIn()) {
			$data["zadatel"] = $this->user->getIdentity()->username;
			$data["user_id"] = $this->user->getId();
		}
		else
			$data["zadatel"] = $val->zadatel;

		$song = $this->songList->add($data);

		$msg = $this->flashMessage("Song byl úspěšně přidán", "success");
		$msg->title = "Yeah!";
		
		$zadatel = isset($val->zadatel) ? $val->zadatel : null;
		$this->logger->log("song", "add", array(
			"id" => $song->id,
			"interpret" => $val->interpret,
			"song" => $val->name,
			"vzkaz" => $val->vzkaz
				), $zadatel);
		
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
				->setCustomRender(function($item){
					$template = $this->createTemplate();
					$template->setFile(__DIR__ . "/../templates/components/Grid/zadatel.latte");
					$template->song = $item;
					return $template;
				})
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
		
		if (!$this->checkPermissions("song", "approve"))
			$this->redirect("list");

		//Mapping additional data
		$additional = array(
			"remix" => $val->remix,
			"instro" => $val->instro,
			"pecka" => $val->pecka
		);

		$this->songList->approve($val->id, $this->user->getId(), $val->note, $additional);

		$msg = $this->flashMessage("Song schválen a zařazen do playlistu", "success");
		$msg->title = "A je tam!";
		$song = $this->songList->find($val->id);
		$this->logger->log("song", "approve", array(
			"id" => $val->id,
			"name" => $song->name,
			"interpret" => $song->interpret_name));
		
		if($this->back) {
			$back = $this->back;
			$this->back = null;
			$this->redirect($back, array("id" => $val->id));
		}
		$this->redirect("list");
	}

	////////////////////////////////////////////////////////////////////////////
	/************************* Song reject ************************************/

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

		if (!$this->checkPermissions("song", "reject"))
			$this->redirect("list");
		
		$this->songList->reject($val->id, $this->user->getId(), $val->note);

		$msg = $this->flashMessage("Song zamítnut a vyřazen z playlistu", "success");
		$msg->title = "A je ze hry!";
		$song = $this->songList->find($val->id);
		$this->logger->log("song", "reject", array(
			"id" => $val->id,
			"reason" => $val->note,
			"name" => $song->name,
			"interpret" => $song->interpret_name
		));
		
		if($this->back) {
			$back = $this->back;
			$this->back = null;
			$this->redirect($back, array("id" => $val->id));
		}
		$this->redirect("list");
	}

	////////////////////////////////////////////////////////////////////////////
	/************************* Song player ************************************/

	public function createComponentPlayer() {
		
		$host = explode(".",$this->playUrl->getHost());
		$provider = Nette\Utils\Strings::lower($host[count($host) - 2]);
		$handler = "\\App\\Controls\\".ucfirst($provider)."Player";
		
		if(class_exists($handler))
			$player = new $handler($this->playUrl);
		else
			$player = new \App\Controls\NoPlayer($this->playUrl);

		return $player;
	}
	
	////////////////////////////////////////////////////////////////////////////
	/************************* Song filter ************************************/
	
	protected function createComponentFilter() {
		$form = new Form();
		
		$form->addCheckbox("remix");
		$form->addCheckbox("instro");
		$form->addCheckbox("pecka");
		$form->addCheckbox("note");
		
		$form->addSubmit("filtruj");
		
		$form->onSuccess[] = function($form) {
			$val = $form->getValues();
			
			$flags = "";
			
			//Mapping
			$val->remix ? $flags .= "r" : null;
			$val->instro ? $flags .= "i" : null;
			$val->pecka ? $flags .= "p" : null;
			$val->note ? $flags .= "n" : null;
			
			$this->redirect("this",array("flags" => $flags));
		};
		
		return $form;
	}

	protected function setFilterDefaults($flags) {
		$form = $this["filter"];
		
		$defaults = array();
		foreach(str_split($flags) as $flag) {
			//Backmapping
			$flag == "r" ? $defaults["remix"] = true : null;
			$flag == "i" ? $defaults["instro"] = true : null;
			$flag == "p" ? $defaults["pecka"] = true : null;
			$flag == "n" ? $defaults["note"] = true : null;
		}
		
		$form->setDefaults($defaults);
	}

	public function handleLike($id) {
		if (!$this->checkPermissions("song","like"))
			$this->flashMessage("Pro lajkování songu se musíte přihlásit", "warning");
		else {
			try {
				$this->songList->like($id, $this->user->id);
				$msg = $this->flashMessage("Hlasovat můžeš každých 24 hodin!","success");
			}
			catch (\Nette\IOException $e) {
				$msg = $this->flashMessage("Hlasovat lze jen jednou za 24 hodin", "warning");
				$msg->title = "Pro tento song jsi již hlasoval(a)!";
			}
		}
		$this->redirect("this");
	}
}