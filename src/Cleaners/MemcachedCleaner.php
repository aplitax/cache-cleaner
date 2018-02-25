<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

class MemcachedCleaner implements ICleaner
{

    public function clean(\Nette\DI\Container $container): void
    {

        /** @var string[] */
        $names = $container->findByType(\Memcached::class);

        foreach ($names as $name) {
            /* @var $memcached \Memcached */
            $memcached = $container->getService($name);
            $memcached->flush();
        }
    }

}
