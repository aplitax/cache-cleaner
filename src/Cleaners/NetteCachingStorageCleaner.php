<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

class NetteCachingStorageCleaner implements ICleaner
{

    public function clean(\Nette\DI\Container $container): void
    {

        /** @var string[] */
        $names = $container->findByType(\Nette\Caching\IStorage::class);

        foreach ($names as $name) {
            /* @var $storage \Nette\Caching\IStorage */
            $storage = $container->getService($name);
            $storage->clean([
                \Nette\Caching\Cache::ALL => true
            ]);
        }
    }

}
