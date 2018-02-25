modette/cache-cleaner
======

Clean application cache with single command

Installation
------------

The best way to install modette/cache-cleaner is using  [Composer](http://getcomposer.org/):

```bash
$ composer require modette/cache-cleaner
```

Configuration
------------

```neon
extensions:
    cacheCleaner: Modette\CacheCleaner\DI\CleanerExtension

cacheCleaner:
    cleaners: # register cleaners which you want
        - Modette\CacheCleaner\Cleaners\ApcCleaner()
        - Modette\CacheCleaner\Cleaners\ApcuCleaner()
        - Modette\CacheCleaner\Cleaners\LocalFilesystemCleaner([%tempDir%])
        - Modette\CacheCleaner\Cleaners\MemcacheCleaner()
        - Modette\CacheCleaner\Cleaners\MemcachedCleaner()
        - Modette\CacheCleaner\Cleaners\NetteCachingStorageCleaner()
        - Modette\CacheCleaner\Cleaners\OpcodeCleaner()
```

Usage
------------

Run command in Symfony console

```bash
$ cache:clean
```

Repository [https://github.com/modette/cache-cleaner](https://github.com/modette/cache-cleaner).

