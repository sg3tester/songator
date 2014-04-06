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
	public $tag;
	
	public function actionDefault() {
		
	}
	
	public function renderDefault($tag) {
		$articles = $this->blog->findAll()->order("datum DESC");
		if ($tag) {
			$articles->where(":blog_tag.tag_id",$tag);
			$this->template->currentTag = $this->tags->find($tag);
		}
		
		/* Paginator */
		$navigator = new \App\Controls\Navigator($this, "paginator");
		$paginator = $navigator->getPaginator();
		$paginator->setItemCount(count($articles));
		$paginator->setItemsPerPage($this->settings->get("blog_paginator", 10));
		
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
		$cloud->destination = "blog:";
		return $cloud;
	}

}
