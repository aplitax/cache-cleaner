<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

class LocalFilesystemCleaner implements ICleaner
{

    /** @var string[] */
    private $directories = [];

    /** @var string[] */
    private $ignored = [];

    public function __construct(array $directories, array $ignored = [])
    {
        $this->directories = $directories;
        $this->ignored = $ignored;
    }

    public function clean(\Nette\DI\Container $container): void
    {

        foreach ($this->directories as $directory) {
            $this->removeFiles($directory);
        }
    }

    private function removeFiles(string $path): void
    {
        if (is_file($path)) {
            unlink($path);
        } elseif (is_dir($path)) {
            foreach (new \FilesystemIterator($path) as $item) {
                $path = $item->getPathname();
                if (!in_array(str_replace('\\', '/', $path), $this->ignored)) {
                    $this->removeFiles($path);
                }
            }
        }
    }

}
