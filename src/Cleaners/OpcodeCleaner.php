<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

use Symfony\Component\Console\Output\OutputInterface;

class OpcodeCleaner implements ICleaner
{

    public function clean(?OutputInterface $output = null): void
    {

        if (!function_exists('opcache_reset')) {
            if ($output !== null) {
                $output->writeln('Skipped opcode cache cleaning, opcache_reset function is not available.');
            }
            return;
        }

        if ($output !== null) {
            $output->writeln('Cleaning opcode cache cache...');
        }

        $success = @opcache_reset();

        if ($output !== null) {
            if ($success) {
                $output->writeln('<info>opcode cache successfully cleaned.</info>');
            } else {
                $output->writeln('<error>opcode cache cannot be cleaned. It is probably restricted by "restrict_api" directive of OPcache API.</error>');
            }
        }
    }

}
