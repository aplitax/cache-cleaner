<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */

declare(strict_types=1);

namespace Modette\CacheCleaner\Cleaners;

use Memcache;
use Nette\DI\Container;
use Symfony\Component\Console\Output\OutputInterface;

class MemcacheCleaner implements ICleaner
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
		$names = $this->container->findByType(Memcache::class);

		if ($names === []) {
			$output->writeln('Skipped Memcache cleaning, no Memcache services found in DI container.');
			return;
		}

		$output->writeln('Cleaning Memcache...');

		foreach ($names as $name) {
			$output->writeln(\sprintf('Cleaning Memcache instance %s...', (string)$name), OutputInterface::VERBOSITY_VERBOSE);

			/** @var Memcache $memcache */
			$memcache = $this->container->getService($name);
			$memcache->flush();
		}

		$output->writeln('<info>Memcache successfully cleaned.</info>');
	}

}
