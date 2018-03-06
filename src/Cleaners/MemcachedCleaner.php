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

    public function clean(?OutputInterface $output = null): void
    {
        /** @var string[] */
        $names = $this->container->findByType(\Memcached::class);

        if ($names === []) {
            if ($output !== null) {
                $output->writeln('Skipped Memcached cleaning, no Memcached services found in DI container.');
            }
            return;
        }

        if ($output !== null) {
            $output->writeln('Cleaning Memcached...');
        }

        foreach ($names as $name) {
            if ($output !== null) {
                $output->writeln(sprintf('Cleaning Memcached instance %s...', (string) $name), OutputInterface::VERBOSITY_VERBOSE);
            }

            /* @var $memcached \Memcached */
            $memcached = $this->container->getService($name);
            $memcached->flush();
        }

        if ($output !== null) {
            $output->writeln('<info>Memcached successfully cleaned.</info>');
        }
    }

}
