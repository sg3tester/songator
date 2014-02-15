<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

    /**
     * @var \TwitterAuthenticator
     * @inject
     */
    public $twitter;
    
	
	public function actionDefault() {
	   
		dump($this->twitter->getAuthToken());
		
		
	}

}
