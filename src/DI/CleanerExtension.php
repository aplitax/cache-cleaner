<?php

/**
 * @copyright      2017 Marek Bartoš
 * @license        See license
 * @author         Marek Bartoš <bartos.developer152@gmail.com>
 */

declare(strict_types=1);

namespace Modette\CacheCleaner\DI;

use Modette\CacheCleaner\CacheCleaner;
use Modette\CacheCleaner\Console\CleanCommand;
use Nette\DI\CompilerExtension;

class CleanerExtension extends CompilerExtension
{

	private $defaults = [
		'cleaners' => []
	];

	public function loadConfiguration(): void
	{

		$this->config = $this->validateConfig($this->defaults);

		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('cleaner'))
			->setType(CacheCleaner::class)
			->setFactory(CacheCleaner::class, [
				$this->config['cleaners']
			]);

		$builder->addDefinition($this->prefix('command'))
			->setType(CleanCommand::class);
	}

}
