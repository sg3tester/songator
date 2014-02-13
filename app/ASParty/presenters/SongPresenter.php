<?php

/**
 * Description of songPresenter
 *
 * @author JDC
 */
class SongPresenter extends BasePresenter {

    /**@var \Nesys\Songy */
    private $songy;
    private $wip;
    /**@var \Nesys\Podobne */
    private $podobne;
	/** @var \Songylog */
	private $songylog;

    public function startup() {
	parent::startup();
	$this->songy = $this->getContext()->songy;
	$this->podobne= $this->getContext()->podobne;
	if ($this->core->getOption("songator_zprava_show"))
	    $this->flashMessage ($this->core->getOption ("songator_zprava"));
    }
	
	public function injectSongylog(\Songylog $slog) {
		$this->songylog = $slog;
	}

		public function renderView($id) {
	$this->template->song = $this->songy->getSong($id);
    }
    
    public function actionBindInterpret($term) {
	$rows = $this->podobne->bind($term)->limit(10);
	/*if ($rows->count() == 0) {
	    $rows = $this->podobne->levenshtein($term);
	}*/
	$songy = array();
	foreach ($rows as $row) {
	    $songy[] = $row->valid;
	}
	$this->sendResponse(new \Nette\Application\Responses\JsonResponse($songy));
    }
    
    public function actionBindSong($interpret,$song,$more = false) {
	$this->template->interpret = $interpret;
	$this->template->song = $song;
	$this->template->more = $more;
	$potencial = $this->podobne->match($interpret);
	if ($potencial->count() > 0) {
	    $podobne = $potencial->fetch()->aliases;
	    $podobne = str_replace(",", "|", $podobne);
	    $interpret .= "|".$podobne;
	}
	$interpret = str_replace("(","\\(",$interpret);
	$interpret = str_replace(")","\\)",$interpret);
	$interpret = str_replace("[","\\[",$interpret);
	$interpret = str_replace("]","\\]",$interpret);
	$this->template->songy = $this->songy->findAll()->where("interpret REGEXP ?",$interpret)->where("song LIKE ?","%$song%");
	if (!$more)
	    $this->template->songy->limit(10);
    }
    
    public function actionMatchInterpret($interpret) {
	$match = $this->podobne->match($interpret);
	if ($match->count() == 0) {
	    $match = $this->podobne->levenshtein($interpret);
	}
	$this->template->matches = $match;
	$this->template->matching = $interpret;
    }

    public function actionEdit($id) {
		if(!$this->getUser()->isAllowed("system", "view")){
			$this->redirect("homepage:");
		}
		else {
			$data = $this->songy->getSong($id);
			$this->template->id = $id;
			$this->getComponent("editSong")->setDefaults($data);
		}
    }
    
    public function createComponentEditSong() {
	$form = new \Nette\Application\UI\Form();
	
	$form->addText("interpret","Interpret:",55)
		->setRequired("Musíte zadat interpreta");
	$form->addText("song","Název songu:",55)
		->setRequired("Musíte zadat název songu");
	$form->addSelect("zanr","Žánr:",array ("K-POP" => "K-POP","J-POP" => "J-POP","C-POP" => "C-POP","Thai Pop" => "Thai Pop","Jiná asijská hudba" => "Jiná asijská hudba"))
		->setRequired("Musíte zadat žánr, pod který je song zahrnut");
	$form->addText("yt","Link k poslechnutí: (např. Youtube)",55);
	$form->addText("zadatel","Váš Nick:")
		->setRequired("Musíte zadat vaši přezdívku");
	$form->addTextArea("vzkaz","Vzkaz pro DJe: (max 255 znaků)",44,4)
		->addRule(\Nette\Application\UI\Form::MAX_LENGTH,"Text nesmí přesáhnout 255 znaků",255);
	$form->addTextArea("note","Poznámka DJe: (max 512 znaků)",44,4)
		->addRule(\Nette\Application\UI\Form::MAX_LENGTH,"Text nesmí přesáhnout 255 znaků",512);
		$form->addSelect("status", "Status", array("waiting" => "Čeká","approved" => "Schválen", "rejected" => "Vyřazen"))
		->setRequired("Musíte určit status");
	$form->addCheckbox("pecka","Tenhle song je pecka!");
	$form->addCheckbox("instro","Song má k dispozici instrumentálku");
	$form->addHidden("id");
	$form->addSubmit("odeslat","Upravit song");
	$form->onSuccess[] = $this->editSongSuccess;
	
	return $form;
    }
    
    public function editSongSuccess(\Nette\Application\UI\Form $form) {
	$val = $form->getValues();
	
	$data["interpret"] = $val->interpret;
	$data["song"] = $val->song;
	$data["zanr"] = $val->zanr;
	$data["zadatel"] = $val->zadatel;
	$data["vzkaz"] = $val->vzkaz;
	$data["status"] = $val->status;
	$data["yt"] = $val->yt;
	$data["instro"] = $val->instro;
	$data["pecka"] = $val->pecka;
	$data["note"] = $val->note;
	
	$this->songy->editSong($val->id,$data);
	$this->flashMessage("Song upraven", "success");
	$this->core->log(\Nesys\NesysCore::LOG_ACTION, $_SERVER['REMOTE_ADDR']."(".$this->getUser()->getIdentity()->user.") upravil(a) song ".$data["interpret"]." - ".$data["song"]);
	$this->redirect("this");
	
    }
    
    public function actionReason($id) {
	if(!$this->getUser()->isAllowed("system", "view")){
	    $this->redirect("homepage:");
	}
	else {
	    $data["id"] = $id;
	    $this->template->id = $id;
	    $this->getComponent("reason")->setDefaults($data);
	}
    }
    
    public function createComponentReason() {
	$form = new \Nette\Application\UI\Form();
	
	$form->addTextArea("note","",44,4)
		->setHtmlId("reason")
		->addRule(\Nette\Application\UI\Form::MAX_LENGTH,"Text nesmí přesáhnout 255 znaků",255);
	$form->addHidden("id");
	$form->addSubmit("odeslat","Zapsat");
	$form->onSuccess[] = $this->reasonSuccess;
	
	return $form;
    }
    
    public function reasonSuccess(\Nette\Application\UI\Form $form) {
	$val = $form->getValues();
	
	$data["note"] = $val->note;
	
	$this->songy->editSong($val->id,$data);
	$this->flashMessage("Důvod zamítnutí byl udán", "success");
	$this->core->log(\Nesys\NesysCore::LOG_ACTION, $_SERVER['REMOTE_ADDR']."(".$this->getUser()->getIdentity()->user.") udal(a) důvod zamítnutí pro song ".$data["interpret"]." - ".$data["song"]);
	$this->redirect("list#track$val->id");
	
    }
    
    public function createComponentAttrFilter() {
	$form = new \Nette\Application\UI\Form();
	
	$form->addCheckbox("pecka");
	$form->addCheckbox("instro");
	$form->addCheckbox("note");
	
	$form->addSubmit("tridit","Třídit");
	$form->onSuccess[] = $this->attrFilterSuccess;
	
	return $form;
    }
    
    public function createComponentSearch() {
	
	$form = new \Nette\Application\UI\Form();
	
	$form->addText("search","Hledat:")
		->setAttribute("placeholder", "Co hledáte?");
	
	$form->addSubmit("hledej","Hledej");
	$form->onSuccess[] = $this->searchSuccess;
	
	return $form;
    }
    
    public function searchSuccess(\Nette\Application\UI\Form $form) {
	$val = $form->getValues();
	
	$this->redirect("this",array("search" => $val->search));
    }


    public function attrFilterSuccess(\Nette\Application\UI\Form $form) {
	$val = $form->getValues();
	
	$this->redirect("this",array("filter" => array("pecka" => $val->pecka,"instro" => $val->instro,"note" => $val->note)));
    }
    
    public function renderAdd() {
	$this->template->wip = $this->core->getOption("as_wip");
	$this->template->active = $this->core->getOption ("songator_active");
	$this->template->rows = $this->songy->findAll()->group("interpret");
	if ($this->getUser()->isLoggedIn())
	    $this->getComponent("addSong")->setDefaults(array("zadatel" => $this->getUserIdentity()->user));
	if ($this->template->wip)
	    $this->flashMessage("Funkce přidávání songů je dočasně vypnutá. DJ momentálně nestíhá zpracovávat všechny songy ve frontě. Aby vyrovnal tento deficit, dočasně vypnul funkci přidávání songů. Vyčkejte prosím ěkolik minut a vraťte se sem později. Děkujeme za pochopení. ");
	if (!$this->template->active)
	    $this->flashMessage ("Playlist je uzavřen. Děkujeme za vaší pomoc při jeho tvorbě. Uvidíme se na AsianStyle párty ^^","success");
    }

    public function renderList($status = null, $sort = "datum DESC",array $filter = null, $search = null) {
	
		$likez = $this->getHttpRequest()->getCookie("likes_6432", array());
			if(is_string($likez))
				$likez = Nette\Utils\Json::decode($likez);

		$radic = new \Nesys\Sorter();
		$radic->addHeads(array ("datum" => "Datum", "interpret" => "Interpret", "song" => "Song", "zanr" => "Žánr", "zadatel" => "Žadatel", "status" => "Status", "vzkaz" => "Vzkaz", "likes" => Nette\Utils\Html::el("span")->addAttributes(array("class" => "icon-heart"))));
		$radic->sort($sort);
		$this->template->heads = $radic->flush();
		$this->template->search = $search;
		$this->template->likez = $likez;
		$this->getComponent("search")->setDefaults(array("search" => $search));
		if ($filter != null)
			$this->getComponent("attrFilter")->setDefaults($filter);
		if ($filter == null) {
			$songy = $this->songy->getSongs($status);
			if ($search != null) {
			$this->search($search, $songy);
			}
			$this->template->songy = $songy->order($sort);
		}
		else {
			//dump($filter["instro"]);
			$statement = "";
			$q = null;
			if ($filter["instro"]) {
			$q[] = "instro = 1";
			}
			if ($filter["pecka"]) {
			$q[] = "pecka = 1";
			}
			if ($filter["note"]) {
			$q[] = "note != ''";
			}
			$qc = 0;
			$qmc = \count($q);
			if ($q != null) {
			foreach ($q as $qr) {
				$statement .= $qr;
				if ($qc != $qmc - 1)
				$statement .= " OR ";
				$qc++;
			}
			}
			$songy = $this->songy->getSongs($status);
			if ($statement != "")
			$songy->where($statement);

			if ($search != null) {
			$this->search($search, $songy);
			}

			$this->template->songy = $songy->order($sort);
		}
		$wip = $this->core->getOption("as_wip");
		$this->template->active = $this->core->getOption ("songator_active");
		if ($wip) {
			$this->flashMessage("DJ momentálně zpracovává frontu songů. Zdržte se chvíli s přidáváním svých tipů a omluvte menší komplikace. Děkujeme za pochopení");
		}
		if (!$this->template->active)
			$this->flashMessage ("Playlist je uzavřen. Děkujeme za vaší pomoc při jeho tvorbě. Uvidíme se na AsianStyle párty ^^","success");
		$this->wip = $wip;
		$this->template->wip = $wip;
    }
    
    public function beforeRender() {
	parent::beforeRender();
	$this->template->page = $this->getContext()->obsah->getByShortcut($this->getView());
    }
    
    public function createComponentAddSong() {
	$form = new \Nette\Application\UI\Form();
	
	$form->addText("interpret","Interpret:",55)
		->setRequired("Musíte zadat interpreta")
		->setHtmlId("interpret");
	$form->addText("song","Název songu:",55)
		->setRequired("Musíte zadat název songu")
		->setHtmlId("song");
	$form->addSelect("zanr","Žánr:",array ("K-POP" => "K-POP","J-POP" => "J-POP","C-POP" => "C-POP","Thai Pop" => "Thai Pop","Jiná asijská hudba" => "Jiná asijská hudba"))
		->setRequired("Musíte zadat žánr, pod který je song zahrnut");
	$form->addText("yt","Link k poslechnutí: (např. Youtube)",55);
	$form->addText("zadatel","Váš Nick:")
		->setRequired("Musíte zadat vaši přezdívku");
	$form->addTextArea("vzkaz","Vzkaz pro DJe: (max 255 znaků)")
		->addRule(\Nette\Application\UI\Form::MAX_LENGTH,"Text nesmí přesáhnout 255 znaků",255);
	$form->addCheckbox("souhlas","Souhlasím s podmínkami uvedenými výše")
		->setRequired("Musíte souhlasit s podmínkami");
	$form->addSubmit("odeslat","Přidat song");
	$form->onValidate[] = $this->addSongValidate;
	$form->onSuccess[] = $this->addSongSuccess;
	
	return $form;
    }
    
    public function addSongValidate(\Nette\Application\UI\Form $form) {
	if ($this->core->getOption("as_wip"))
	    $form->addError("Momentálně nelze přidávat songy. Funkce je dočasně vypnutá. Zkuste to prosím později");
	if (!$this->core->getOption("songator_active") && !$this->getUser()->isAllowed("article","add"))
	    $form->addError ("Playlist je uzavřen. Nelze přidávat songy");
    }

    public function addSongSuccess(\Nette\Application\UI\Form $form) {
	$val = $form->getValues();
	
	$data["interpret"] = $val->interpret;
	$data["song"] = $val->song;
	$data["zanr"] = $val->zanr;
	$data["zadatel"] = $val->zadatel;
	$data["vzkaz"] = $val->vzkaz;
	$data["status"] = "waiting";
	$data["yt"] = $val->yt;
	
	if (!$this->songy->songExists($data["interpret"], $data["song"])) {
	    $this->songy->addSong($data);
	    $this->flashMessage("Váš song byl přidán do playlistu ke schválení", "success");
	    $this->core->log(\Nesys\NesysCore::LOG_ACTION, $_SERVER['REMOTE_ADDR']."(".$data["zadatel"].") přidal(a) song ".$data["interpret"]." - ".$data["song"]);
	    $this->redirect("this");
	}
	else {
	    $this->flashMessage("Tento song už se nachází v našem seznamu", "error");
	}
    }
    
    /**
     * Execute a action if user has a privileges for do this
     * @param string $resource
     * @param string $privilege
     * @param function $callback
     * @return boolean
     */
    public function doAction($resource,$privilege,$callback) {
	$cb = \Nette\Callback::create($callback);
	
	if ($this->getUser()->isAllowed($resource, $privilege)) {
	    $cb->invoke();
	    return true;
	}
	else 
	    return false;
    }
    
    /* Handlers */
    
    public function handleApprove($id) {
	$this->doAction("system", "view", function() use ($id) {
		    $this->songy->setStatus($id, "approved",$this->getUser()->getId());
		    $this->flashMessage("Song schválen","success"); 
		    $song = $this->songy->getSong($id);
		    $this->core->log(\Nesys\NesysCore::LOG_ADMIN, $_SERVER['REMOTE_ADDR']."(".$this->getUser()->getIdentity()->user.") schválil(a) song ".$song->interpret." - ".$song->song);
	});
	$this->redirect("this#track$id");
    }
    
    public function handleReject($id) {
	$this->doAction("system", "view", function() use ($id) {
		    $this->songy->setStatus($id, "rejected",$this->getUser()->getId());
		    $this->flashMessage("Song zamítnut","success"); 
		    $song = $this->songy->getSong($id);
		    $this->core->log(\Nesys\NesysCore::LOG_ADMIN, $_SERVER['REMOTE_ADDR']."(".$this->getUser()->getIdentity()->user.") zamítl(a) song ".$song->interpret." - ".$song->song);
	});
	$this->redirect("reason",array("id" => $id));
    }
    
    public function handleEdit($id) {
	$this->redirect("edit",array("id" => $id));
    }
    
    public function handleDelete($id) {
	$this->doAction("system", "view", function() use ($id) {
		    $song = $this->songy->getSong($id);
		    $this->core->log(\Nesys\NesysCore::LOG_ADMIN, $_SERVER['REMOTE_ADDR']."(".$this->getUser()->getIdentity()->user.") smazal(a) song ".$song->interpret." - ".$song->song);
		    $this->songy->remove($id);
		    $this->flashMessage("Song smazán","success"); 
	});
	$this->redirect("this");
    }
	
	public function handleLikeSong($id,$confirm) {
		if ($confirm != md5($id)) {
			$this->flashMessage("Neplatný požadavek", "error");
			$this->redirect("this");
		}
		$likez = $this->getHttpRequest()->getCookie("likes_6432", array());
		if(is_string($likez))
			$likez = Nette\Utils\Json::decode($likez);
		
		if ($this->songylog->spammerDetect($_SERVER["REMOTE_ADDR"])) {
			$this->ban->add($_SERVER["REMOTE_ADDR"]);
			$this->core->log(\Nesys\NesysCore::LOG_ACTION, $_SERVER["REMOTE_ADDR"]." banned due to spam (liking flood)");
			$this->redirect("this");
		}
		
		if(!in_array($id, $likez)) {
			$this->songy->like($id);
			$this->songylog->log($_SERVER["REMOTE_ADDR"], $id);
			$likez[] = $id;
			$this->getHttpResponse()->setCookie("likes_6432", Nette\Utils\Json::encode($likez), "2 years");
			$this->flashMessage("Song olajkován", "success");
			$this->redirect("this#track$id");
		}
		$this->flashMessage("Tento song jsi už lajkoval","error");
		$this->redirect("this#track$id");
	}

	public function handleWipOn() {
	$this->doAction("system", "view", function(){
	    $this->core->setOption("as_wip", true);
	});
	$this->redirect("this");
    }
    
     public function handleWipOff() {
	$this->doAction("system", "view", function(){
	    $this->core->setOption("as_wip", false);
	});
	$this->redirect("this");
    }
    
    protected function search($search,$songy) {
	$searchStrip = \str_replace(" ", "", $search);
		$podobne = $this->podobne->match($search);
		if ($podobne->count() > 0) {
		    $fetch = $podobne->fetch();
		    $podobne = $fetch->aliases;
		    $this->template->navrhovany = $fetch->valid;
		    $search .= str_replace(",", "|", $podobne);
		}
		else {
		    $fetch = $this->podobne->levenshtein($search)->fetch();
		    $this->template->navrhovany = $fetch->valid;
		}
		$search = str_replace("(","\\(",$search);
		$search = str_replace(")","\\)",$search);
		$search = str_replace("[","\\[",$search);
		$search = str_replace("]","\\]",$search);
		$songy->where("CONCAT(song,interpret) REGEXP ? OR CONCAT(song,interpret) LIKE ?
			 OR MATCH (song,interpret) AGAINST (? IN BOOLEAN MODE)",
			"$search|$searchStrip","%$search%","$search"); 
    }
    

}