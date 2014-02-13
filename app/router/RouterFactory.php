<?php

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public function createRouter()
	{
		
		
		$router = new RouteList();
		$router[] = new Route('index.php', 'Homepage:default', Route::ONE_WAY);
		$router[] = New Route("cp/register", "Sign:up");
		$router[] = new Route("cp/login", "Sign:in");
		$router[] = new Route("cp/logout", "Sign:out");
    /* ADMINEX - Administrace systému. NEMAZAT! */
		$router[] = new Route("adminex/<presenter>/<action>[/<id>]", array(
		    'module' => 'system',
		    'presenter' => 'System',
		    'action' => 'default',
		    ));
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default'); //Tento řádek nikdy nemazat!
		return $router;
	}

}
