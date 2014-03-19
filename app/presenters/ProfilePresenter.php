<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form,
	App\Model;


/**
 * Homepage presenter.
 */
class ProfilePresenter extends BasePresenter
{

	/** @var \App\UserManager @inject */
	public $usrmgr;
	
	public function actionCreate() {
		if (!$this->user->isLoggedIn() || $this->usrmgr->hasProfile($this->user->id))
			$this->redirect("homepage:");
		
		if ($this->twitter->isTwitterUser()) {
			$info = $this->twitter->verifyCredentials();
			$defaults = array(
				"realname" => $info->name,
				"twitter" => $info->screen_name,
				"about" => $info->description
			);
			if (count($info->entities->url->urls)) {
				$defaults["www"] = $info->entities->url->urls[0]->expanded_url;
			}
		}
		else {
			$identity = $this->user->getIdentity();
			$defaults = array(
				"realname" => $identity->username
			);
		}
		
		$this["profileCreate"]->setDefaults($defaults);
	}
	
	protected function createComponentProfileCreate() {
		$form = new Form();
		
		$form->addText("realname");
		$form->addText("twitter");
		$form->addText("www");
		$form->addTextArea("about");
		
		$form->addSubmit("create");
		
		$form->onSuccess[] = $this->profileCreateSuccess;
		
		return $form;
	}
	
	public function profileCreateSuccess(Form $form) {
		$val = $form->getValues(true);
		
		if ($this->twitter->isTwitterUser()) {
			$info = $this->twitter->verifyCredentials();
			$val["avatar"] = $info->profile_image_url;
		}
		
		$this->usrmgr->createProfile($this->user->id, $val);
		
		$this->redirect("Homepage:");
	}

}
