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

	/** @var \App\Model\InterpretRepository @inject */
	public $interpreti;

	/** @var \App\UserManager @inject */
	public $users;

	/** @var \App\Model\Lastfm\Databox @inject */
	public $lfm;
	protected $playUrl;

	public function actionEditor($id) {
		if ($id && $song = $this->songy->find($id)) {
			$song_arr = $song->toArray();
			$song_arr['reason_code'] = array_key_exists($song_arr['reason_code'], \Rejections::$reasons) ? $song_arr['reason_code'] : null;
			
			//Load flags
			$song_arr['flags'] = [];
			foreach ($this['songEditor']['flags']->getItems() as $key => $item) {
				if ($song->$key)
					$song_arr['flags'][] = $key;
			}
			
			$this['songEditor']->setDefaults($song_arr);
			$this['songEditor']['send']->caption = 'Uložit';
			$this->template->isEdit = true;
			$this->template->song = $song;
			$this->playUrl = new \Nette\Http\UrlScript($song->link);
		}
	}

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

	public function handleDeleteSong($id) {
		$song = $this->songy->find($id);
		if (!$song) {
			$msg = $this->flashMessage("Tenhle song neexistuje.", 'danger');
			$msg->title = 'Oh shit!';
			$msg->icon = 'warning';
			$this->redirect('this');
		}
		try {
			$song->delete();
			$msg = $this->flashMessage("Song '$song->name' úspěšně smazán.", 'success');
			$msg->title = 'Yehet!';
			$msg->icon = 'check';
		} catch (\PDOException $ex) {
			\Nette\Diagnostics\Debugger::log($ex);
			$msg = $this->flashMessage("Něco se podělalo. Zkuzte to prosím později.", 'danger');
			$msg->title = 'Oh shit!';
			$msg->icon = 'warning';
		}
		$this->redirect('this');
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
			\Nette\Diagnostics\Debugger::log($ex);
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

		$grid->addActionHref("editor", "Editovat")
				->setIcon("pencil");

		$grid->addActionHref('delete', 'Smazat', 'deleteSong!')
				->setIcon('trash')
				->setConfirm('Opravdu chcete smazat tento song?');

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

	protected function createComponentSongEditor() {
		$form = new Form();

		$form->addText('name', 'Song')
				->setRequired('Zadejte název songu');

		$form->addText('interpret_name', 'Interpret')
				->setRequired('Zadejte jméno interpreta');

		$form->addSelect('interpret_id', 'Asociovat s', $this->interpreti->findAll()->fetchPairs('id', 'nazev'))
				->setPrompt('Vyberte asociaci');

		$form->addSelect('zanr_id', 'Žánr', $this->zanry->findAll()->fetchPairs('id', 'name'))
				->setPrompt('Vyberte žánr')
				->setRequired('Vyberte žánr songu');

		$form->addSelect('status', 'Status', [
					'waiting' => 'Čeká na schválení',
					'approved' => 'Schválen',
					'rejected' => 'Zamítnut'
				])
				->setRequired('Zadejte stav songu');

		$form->addSelect('reason_code', 'Kód zamítnutí', \Rejections::$reasons)
				->setPrompt('Vyberte kód zamítnutí')
				->addConditionOn($form['status'], Form::EQUAL, 'rejected')
				->addRule(Form::FILLED, 'Musíte udat kód zamítnutí');

		$form->addText('zadatel', 'Přezdívka žadatele')
				->addCondition(Form::FILLED)
				->addRule(Form::MIN_LENGTH, 'Přezdívka žadatele musí mít minimálně %s znaků', 3);

		$form->addSelect('user_id', 'Účet žadatele', $this->users->getUsers()->fetchPairs('id', 'username'))
				->setPrompt('Vyberte uživatele');

		$form->addCheckboxList('flags', 'Flagy', [
			'pecka' => 'Pecka',
			'instro' => 'Má instro',
			'remix' => 'Remix',
			'wishlist_only' => 'Pouze na přání'
		]);

		$form->addText('link', 'URL k poslechu')
				->addCondition(Form::FILLED)
				->addRule(Form::URL, 'URL není v platném formátu');

		$form->addTextArea('note', 'Poznámka DJe');

		$form->addTextArea('vzkaz', 'Vzkaz pro DJe');

		$form->addCheckbox('private_vzkaz', 'Vzkaz je soukromý');

		$form->addHidden('id');

		$form->addSubmit('send', 'Přidat');

		$form->onSuccess[] = function(Form $f) {
			$val = $f->getValues(true);

			foreach ($val['flags'] as $flag) {
				$val[$flag] = true;
			}
			unset($val['flags']); //clear bordel
			//If requester not filled => assign to you
			if (!$val['zadatel'] && !$val['user_id']) {
				$val['zadatel'] = $this->user->identity->username;
				$val['user_id'] = $this->user->id;
			}

			//If requester not filled BUT USER ID engaged => fetch username for requester name
			if (!$val['zadatel'] && $val['user_id']) {
				$val['zadatel'] = $this->users->getUser($val['user_id'])->username;
			}

			try {
				if ($val['id']) {
					$original = $this->songy->find($val['id']);
					if ($original->status != $val['status'])
						$val['revisor'] = $this->user->id;
					$original->update($val);
					$msg = $this->flashMessage("Song '{$val['interpret_name']} - {$val['name']}' upraven.", 'success');
					$msg->title = 'A je tam!';
					$msg->icon = 'check';
				} else {
					$val['image'] = $this->lfm->getTrackImage($val['interpret_name'], $val['name']) ? : '';
					$val['revisor'] = $this->user->id;
					$this->songy->add($val);
					$msg = $this->flashMessage("Song '{$val['interpret_name']} - {$val['name']}' přidán.", 'success');
					$msg->title = 'A je tam!';
					$msg->icon = 'check';
				}
			} catch (\UnexpectedValueException $e) {
				$msg = $this->flashMessage($e->getMessage(), 'danger');
				$msg->title = 'Oh shit!';
				$msg->icon = 'exclamation';
			}
			$this->redirect('this');
		};

		return $form;
	}

	public function createComponentPlayer() {

		$host = explode(".", $this->playUrl->getHost());
		$provider = \Nette\Utils\Strings::lower($host[count($host) - 2]);
		$handler = "\\App\\Controls\\" . ucfirst($provider) . "Player";

		if (class_exists($handler))
			$player = new $handler($this->playUrl);
		else
			$player = new \App\Controls\NoPlayer($this->playUrl);

		return $player;
	}

}
