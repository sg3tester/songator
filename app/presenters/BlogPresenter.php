<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class BlogPresenter extends BasePresenter
{

	/** @var \App\Model\BlogRepository @inject */
	public $blog;
	
	/** @var \App\Model\TagRepository @inject */
	public $tags;
	
	public function actionDefault() {
		
	}
	
	public function renderDefault($tag) {
		$articles = $this->blog->findAll()->order("datum DESC");
		if ($tag) {
			$articles->where(":blog_tag.tag_id",$tag);
			$this->template->currentTag = $this->tags->find($tag);
		}
		$this->template->articles = $articles;
	}
	
	protected function beforeRender() {
		parent::beforeRender();
		$this->template->last = $this->blog->findAll()->limit(5)->order("datum DESC");
	}

}
