<?php

namespace App\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CallCommand extends Command {

	protected function configure() {
		$this->setName('call')
			->setDescription('Call a service')
			->addArgument("service",InputArgument::REQUIRED);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$di = $this->getHelper('container')->getContainer();
		$service_name = $input->getArgument('service');
		if (!$di->hasService($service_name)) {
			$output->writeln("Service '$service_name' not found");
			return 1;
		}
		try {
			$service = $di->getService($service_name);
			$output->writeln(var_export($service));
			return 0;
		}
		catch (\Exception $e) {
			$output->writeln($e->getMessage());
			return 1;
		}
	}

} 