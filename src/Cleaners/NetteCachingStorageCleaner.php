<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */

declare(strict_types=1);

namespace Modette\CacheCleaner\Cleaners;

use Nette\Caching\Cache;
use Nette\Caching\IStorage;
use Nette\DI\Container;
use Symfony\Component\Console\Output\OutputInterface;

class NetteCachingStorageCleaner implements ICleaner
{

	/**
	 * @var Container
	 */
	private $container;

	public function __construct(Container $container)
	{
		$this->container = $container;
	}

	public function clean(OutputInterface $output): void
	{
		/** @var int[]|string[] */
		$names = $this->container->findByType(IStorage::class);

		if ($names === []) {
			$output->writeln('Skipped Nette\Cache\IStorage cleaning, no IStorage services found in DI container.');
			return;
		}

		$output->writeln('Cleaning Nette\Caching\IStorage...');

		foreach ($names as $name) {
			$output->writeln(\sprintf('Cleaning storage instance %s...', (string)$name), OutputInterface::VERBOSITY_VERBOSE);

			/* @var $storage IStorage */
			$storage = $this->container->getService($name);
			$storage->clean([
				Cache::ALL => true
			]);
		}

		$output->writeln('<info>Nette\Caching\IStorage successfully cleaned.</info>');
	}

}
