<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */

declare(strict_types=1);

namespace Modette\CacheCleaner\Console;

use Modette\CacheCleaner\CacheCleaner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CleanCommand extends Command
{

	/** @var CacheCleaner */
	private $cleaner;

	public function __construct(CacheCleaner $cleaner)
	{
		parent::__construct('cache:clean');
		$this->cleaner = $cleaner;
	}

	protected function configure(): void
	{
		$this->setDescription('Clean all caches');
	}

	protected function execute(InputInterface $input, OutputInterface $output): ?int
	{
		$this->cleaner->clean($output);

		return 0;
	}

}
