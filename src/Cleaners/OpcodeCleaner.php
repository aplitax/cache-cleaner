<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

class OpcodeCleaner implements ICleaner
{

    public function clean(\Nette\DI\Container $container): void
    {

        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
    }

}
