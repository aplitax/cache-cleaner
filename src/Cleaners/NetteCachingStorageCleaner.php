<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

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

    public function clean(?OutputInterface $output = null): void
    {
        /** @var string[] */
        $names = $container->findByType(\Nette\Caching\IStorage::class);

        if ($names === []) {
            if ($output !== null) {
                $output->writeln('Skipped Nette\Cache\IStorage cleaning, no IStorage services found in DI container.');
            }
            return;
        }

        if ($output !== null) {
            $output->writeln('Cleaning Nette\Caching\IStorage...');
        }

        foreach ($names as $name) {
            if ($output !== null) {
                $output->writeln(sprintf('Cleaning storage instance %s...', (string) $name), OutputInterface::VERBOSITY_VERBOSE);
            }

            /* @var $storage \Nette\Caching\IStorage */
            $storage = $container->getService($name);
            $storage->clean([
                \Nette\Caching\Cache::ALL => true
            ]);
        }

        if ($output !== null) {
            $output->writeln('<info>Nette\Caching\IStorage successfully cleaned.</info>');
        }
    }

}
