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

    public function clean(?OutputInterface $output = null): void
    {
        /** @var string[] */
        $names = $this->container->findByType(\Memcache::class);

        if ($names === []) {
            if ($output !== null) {
                $output->writeln('Skipped Memcache cleaning, no Memcache services found in DI container.');
            }
            return;
        }

        if ($output !== null) {
            $output->writeln('Cleaning Memcache...');
        }

        foreach ($names as $name) {
            if ($output !== null) {
                $output->writeln(sprintf('Cleaning Memcache instance %s...', (string) $name), OutputInterface::VERBOSITY_VERBOSE);
            }

            /* @var $memcache \Memcache */
            $memcache = $this->container->getService($name);
            $memcache->flush();
        }

        if ($output !== null) {
            $output->writeln('<info>Memcache successfully cleaned.</info>');
        }
    }

}
