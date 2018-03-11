<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner;

class CacheCleaner
{

    /** @var array */
    private $cleaners = [];

    public function __construct(array $cleaners)
    {
        $this->cleaners = $cleaners;
    }

    public function clean(\Symfony\Component\Console\Output\OutputInterface $output): void
    {
        if ($this->cleaners === []) {
            $output->writeln('Cache cleaning skipped, no cleaners defined.');
            return;
        }

        foreach ($this->cleaners as $cleaner) {
            $cleaner->clean($output);
        }

        $output->writeln('<info>Cache successfully cleaned.</info>');
    }

}
