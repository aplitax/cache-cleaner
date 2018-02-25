<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner;

class Cleaner
{

    /** @var \Nette\DI\Container */
    private $container;

    /** @var array */
    private $cleaners = [];

    public function __construct(\Nette\DI\Container $container, array $cleaners)
    {
        $this->container = $container;
        $this->cleaners = $cleaners;
    }

    public function clean(): void
    {
        foreach ($this->cleaners as $cleaner) {
            $cleaner->clean($this->container);
        }
    }

}
