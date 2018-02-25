<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

class ApcCleaner implements ICleaner
{

    public function clean(\Nette\DI\Container $container): void
    {

        if (function_exists('apc_clear_cache')) {
            apc_clear_cache(); // system cache
            apc_clear_cache('user'); // user cache
        }
    }

}
