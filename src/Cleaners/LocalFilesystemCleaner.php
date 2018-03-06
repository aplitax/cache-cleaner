<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

use Nette\DI\Container;
use Symfony\Component\Console\Output\OutputInterface;

class LocalFilesystemCleaner implements ICleaner
{

    /**
     * @var string[]
     */
    private $directories = [];

    /**
     * @var string[]
     */
    private $ignored = [];

    /**
     * @var Container
     */
    private $container;

    public function __construct(array $directories, array $ignored = [], Container $container)
    {
        $this->directories = $directories;
        $this->ignored = $ignored;
        $this->container = $container;
    }

    public function clean(?OutputInterface $output = null): void
    {
        if ($this->directories === []) {
            if ($output !== null) {
                $output->writeln('Skipped local filesystem cache cleaning, no directories defined.');
            }
            return;
        }

        if ($output !== null) {
            $output->writeln('Cleaning local filesystem cache...');
        }

        foreach ($this->directories as $directory) {
            if ($output !== null) {
                $output->writeln(sprintf('Cleaning directory %s...', $directory), OutputInterface::VERBOSITY_VERBOSE);
            }

            $this->removeFiles($directory);
        }

        if ($output !== null) {
            $output->writeln('<info>Local filesystem cache successfully cleaned.</info>');
        }
    }

    private function removeFiles(string $path): void
    {
        if (is_file($path)) {
            unlink($path);
        } elseif (is_dir($path)) {
            foreach (new \FilesystemIterator($path) as $item) {
                $path = $item->getPathname();
                if (!in_array(str_replace('\\', '/', $path), $this->ignored, true)) {
                    $this->removeFiles($path);
                }
            }
        }
    }

}
