<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\DI;

class CleanerExtension extends \Nette\DI\CompilerExtension
{

    private $defaults = [
        'cleaners' => []
    ];

    public function loadConfiguration(): void
    {

        $this->config = $this->validateConfig($this->defaults);

        $builder = $this->getContainerBuilder();

        $builder->addDefinition($this->prefix('cleaner'))
            ->setType(\Modette\CacheCleaner\CacheCleaner::class)
            ->setFactory(\Modette\CacheCleaner\CacheCleaner::class, [
                $this->config['cleaners']
        ]);

        $builder->addDefinition($this->prefix('command'))
            ->setType(\Modette\CacheCleaner\Console\CleanCommand::class);
    }

}
