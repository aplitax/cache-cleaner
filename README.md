# modette/cache-cleaner

Clean application cache with single command

## Installation

The best way to install modette/cache-cleaner is using [Composer](http://getcomposer.org/):

```bash
$ composer require modette/cache-cleaner
```

Register in your `config.neon`:

```yaml
extensions:
    cacheCleaner: Modette\CacheCleaner\DI\CleanerExtension
```

## Configuration

```yaml
cacheCleaner:
    cleaners: # cleaners list
        - Modette\CacheCleaner\Cleaners\LocalFilesystemCleaner([%tempDir%])
        - Modette\CacheCleaner\Cleaners\NetteCachingStorageCleaner()
```

## Available cleaners

### APC cleaner

- cleans both user and system APC cache

```yaml
Modette\CacheCleaner\Cleaners\ApcCleaner()
```

### APCu cleaner

```yaml
Modette\CacheCleaner\Cleaners\ApcuCleaner()
```

### Local filesystem cleaner

- recursively purge directories
- second parameter accepts directories and files which should be ignored

```yaml
Modette\CacheCleaner\Cleaners\LocalFilesystemCleaner([%tempDir%], [%tempDir%/ignored/])
```

### Memcache cleaner

- cleans all Memcache storages in DI container

```yaml
Modette\CacheCleaner\Cleaners\MemcacheCleaner()
```

### Memcached cleaner

- cleans all Memcached storages in DI container

```yaml
Modette\CacheCleaner\Cleaners\MemcachedCleaner()
```

### Nette caching storage cleaner

- cleans all Nette\Caching\IStorage instances in DI container

```yaml
Modette\CacheCleaner\Cleaners\NetteCachingStorageCleaner()
```

### Opcode cleaner

- cleans opcode

```yaml
Modette\CacheCleaner\Cleaners\OpcodeCleaner()
```

## Usage - via CLI

Run command in Symfony console

```bash
$ cache:clean
```

Add `-v` parameter to display more detailed informations

## Usage - direct

```php
<?php
// get Modette\CacheCleaner\CacheCleaner from DI container
$cleaner->clean(new \Symfony\Component\Console\Output\NullOutput());
```

## Creating your own cleaners

Implement `ICleaner` and register it in cleaners list

```php
<?php

class YourCleaner implements \Modette\CacheCleaner\Cleaners\ICleaner
{

    public function clean(\Symfony\Component\Console\Output\OutputInterface $output): void
    {
        // clean cache
        // inform about it in console
    }

}

```


Repository [https://github.com/modette/cache-cleaner](https://github.com/modette/cache-cleaner).
