<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

class ApcuCleaner implements ICleaner
{

    public function clean(\Nette\DI\Container $container): void
    {

        if (function_exists('apcu_clear_cache')) {
            apcu_clear_cache();
        }
    }

}
