<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

use Symfony\Component\Console\Output\OutputInterface;

class ApcCleaner implements ICleaner
{

    public function clean(OutputInterface $output): void
    {
        if (!function_exists('apc_clear_cache')) {
            $output->writeln('Skipped APC cache cleaning, apc_clear_cache function is not available.');
            return;
        }

        $output->writeln('Cleaning APC cache...');
        $output->writeln('Cleaning APC system cache...', OutputInterface::VERBOSITY_VERBOSE);

        apc_clear_cache(); // system cache

        $output->writeln('Cleaning APC user cache...', OutputInterface::VERBOSITY_VERBOSE);

        apc_clear_cache('user'); // user cache

        $output->writeln('<info>APC cache successfully cleaned.</info>');
    }

}
