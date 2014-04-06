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
	
	/** @persistent */
	public $page = 1;
	
	public function actionDefault() {
		
	}
	
	public function renderDefault($tag) {
		$articles = $this->blog->findAll()->order("datum DESC");
		if ($tag) {
			$articles->where(":blog_tag.tag_id",$tag);
			$this->template->currentTag = $this->tags->find($tag);
		}
		
		/* Paginator */
		$paginator = new Nette\Utils\Paginator;
		$paginator->setItemCount(count($articles));
		$paginator->setItemsPerPage($this->settings->get("blog_paginator", 10));
		$paginator->setPage($this->page);
		
		$articles->limit($paginator->getLength(), $paginator->getOffset()); //Paginate!
		
		$this->template->page = $paginator;
		$this->template->articles = $articles;
	}
	
	protected function beforeRender() {
		parent::beforeRender();
		$this->template->last = $this->blog->findAll()->limit(5)->order("datum DESC");
	}
	
	protected function createComponentTagCloud() {
		$cloud = new \TagCloud();
		$cloud->data = $this->tags->getCloud();
		return $cloud;
	}

}
