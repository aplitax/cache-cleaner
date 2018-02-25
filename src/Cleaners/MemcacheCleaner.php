<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

class MemcacheCleaner implements ICleaner
{

    public function clean(\Nette\DI\Container $container): void
    {

        /** @var string[] */
        $names = $container->findByType(\Memcache::class);

        foreach ($names as $name) {
            /* @var $memcache \Memcache */
            $memcache = $container->getService($name);
            $memcache->flush();
        }
    }

}
