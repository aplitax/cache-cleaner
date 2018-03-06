<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Console;

class CleanCommand extends \Symfony\Component\Console\Command\Command
{

    /** @var \Modette\CacheCleaner\Cleaner */
    private $cleaner;

    public function __construct(\Modette\CacheCleaner\CacheCleaner $cleaner)
    {
        parent::__construct('cache:clean');
        $this->cleaner = $cleaner;
    }

    protected function configure()
    {
        $this->setDescription('Clean all caches');
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $this->cleaner->clean($output);
        
        return 0;
    }

}
