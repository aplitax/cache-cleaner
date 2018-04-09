<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */

declare(strict_types=1);

namespace Modette\CacheCleaner\Cleaners;

use Memcached;
use Nette\DI\Container;
use Symfony\Component\Console\Output\OutputInterface;

class MemcachedCleaner implements ICleaner
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
		$names = $this->container->findByType(Memcached::class);

		if ($names === []) {
			$output->writeln('Skipped Memcached cleaning, no Memcached services found in DI container.');
			return;
		}

		$output->writeln('Cleaning Memcached...');

		foreach ($names as $name) {
			$output->writeln(\sprintf('Cleaning Memcached instance %s...', (string)$name), OutputInterface::VERBOSITY_VERBOSE);

			/** @var Memcached $memcached */
			$memcached = $this->container->getService($name);
			$memcached->flush();
		}

		$output->writeln('<info>Memcached successfully cleaned.</info>');
	}

}
