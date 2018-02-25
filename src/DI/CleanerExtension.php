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
            ->setType(\Modette\CacheCleaner\Cleaner::class)
            ->setFactory(\Modette\CacheCleaner\Cleaner::class, [
                '@Nette\DI\Container',
                $this->config['cleaners']
        ]);

        if (class_exists(\Symfony\Component\Console\Command\Command::class)) {
            $builder->addDefinition($this->prefix('command'))
                ->setType(\Modette\CacheCleaner\Console\CleanCommand::class);
        }
    }

}
