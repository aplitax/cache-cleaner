<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */
declare(strict_types = 1);

namespace Modette\CacheCleaner\Cleaners;

interface ICleaner
{

    public function clean(\Symfony\Component\Console\Output\OutputInterface $output): void;

}
