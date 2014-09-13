<?php

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

//$configurator->setDebugMode(TRUE);  // debug mode MUST NOT be enabled on production server
$configurator->enableDebugger(__DIR__ . '/../log');
\Nette\Diagnostics\Debugger::$strictMode = false;
$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
		->addDirectory(__DIR__)
		->addDirectory(__DIR__ . '/../vendor/others')
		->register();

//Load configuration mode
$modeFile = __DIR__ . '/../.mode';
$mode = file_exists($modeFile) ? file_get_contents($modeFile) : 'local';

//Check if Songator is configured
if (!file_exists(__DIR__ . '/config/config.' . $mode . '.neon'))
	die('Songator is not configured yet! Please make a configuration file config.' . $mode . '.neon ;-)');

//Load configuration
$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.' . $mode . '.neon');

$container = $configurator->createContainer();
//$container->application->catchExceptions = true;

//Send songator identify header
@header('X-Powered-By: Songator 3');
@header('X-Version: ' . Songator::VERSION_ID);
@header('X-Runtime: Nette Framework');

return $container;
