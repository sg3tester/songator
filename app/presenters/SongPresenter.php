<?php

namespace App\Presenters;

use Nette,
	Grido,
	App\Model;


/**
 * Song presenter.
 */
class SongPresenter extends BasePresenter
{

	public function actionDefault() {
		
	}
	
	protected function createComponentSongList($name)
	{
		$grid = new Grido\Grid($this, $name);
		$grid->setModel(array(
			array('name' => 'Lucie', 'gender' => 'female'),
			array('name' => 'Petra', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
			array('name' => 'Lenka', 'gender' => 'female'),
		));
		
		$grid->addColumnText("name", "Jméno")->setSortable();
		$grid->addColumnText("gender", "Pohlaví");
		
		$grid->setTemplateFile(__DIR__ . "/../templates/components/Grid.latte");
		
		return $grid;
	}

}
