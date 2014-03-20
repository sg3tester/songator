<?php

require __DIR__ . '/../vendor/autoload.php';

//Check if Songator is installed
if (!file_exists(__DIR__ . '/config/config.local.neon'))
		die('Songator is not installed. <a href="install">Begin installation</a>');

$configurator = new Nette\Configurator;

//$configurator->setDebugMode(TRUE);  // debug mode MUST NOT be enabled on production server
$configurator->enableDebugger(__DIR__ . '/../log');
\Nette\Diagnostics\Debugger::$strictMode = false;
$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->addDirectory(__DIR__ . '/../vendor/others')
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

$container = $configurator->createContainer();
//$container->application->catchExceptions = true;
return $container;
