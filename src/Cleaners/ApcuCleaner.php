<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

use Symfony\Component\Console\Output\OutputInterface;

class ApcuCleaner implements ICleaner
{

    public function clean(OutputInterface $output): void
    {
        if (!function_exists('apcu_clear_cache')) {
            $output->writeln('Skipped APCu cache cleaning, apcu_clear_cache function is not available.');
            return;
        }

        $output->writeln('Cleaning APCu cache...');

        apcu_clear_cache();

        $output->writeln('<info>APCu cache successfully cleaned.</info>');
    }

}
