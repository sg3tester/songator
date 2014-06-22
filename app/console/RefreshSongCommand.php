<?php

namespace App\Console;

use App\Model\Lastfm\Lastfm;
use App\Model\Lastfm\LastfmException;
use App\Model\SongRepository;
use Kdyby\Console\ContainerHelper;
use Nette\DI\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RefreshSongCommand extends Command {

	protected function configure() {
		$this->setName('song:refresh')
			->setDescription('Refresh song images from Last.fm')
			->addArgument("song_id",InputArgument::OPTIONAL);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		/** @var Container $di */
		$di = $this->getHelper('container')->getContainer();
		/** @var SongRepository $songRepo */
		$songRepo = $di->getByType('App\Model\SongRepository');

		$ok_counter = 0;
		$error_counter = 0;

		$songRepo->beginTransaction();
		foreach ($songRepo->findAll() as $song) {
			/** @var Lastfm $lfm */
			$lfm = $di->getByType('App\Model\Lastfm\Lastfm');
			try {
				$image = $lfm->call('Track.getInfo', ['artist' => $song->interpret_name, 'track' => $song->name])
					->track->album->image;
				$songRepo->edit($song->id, ['image' => json_encode($image)]);
				$ok_counter++;
				$output->writeln('[OK] '.$song->interpret_name . ' - ' . $song->name . ' updated!');
			}
			catch (LastfmException $e) {
				$error_counter++;
				$output->writeln("<error>[ERROR] Cannot reach ".$song->interpret_name." - ".$song->name."</error>");
			}
		}
		$songRepo->commit();
		$output->writeln('');
		$output->writeln('DONE! '.$ok_counter.' success, '.$error_counter.' failed');
	}

} 