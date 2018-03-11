# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2018-03-11
### Added
- Better console integration - cleaners write their current state in console
### Changed
- ICleaner interface - Require \Symfony\Component\Console\Output\OutputInterface instead of \Nette\DI\Container
- Cleaners get \Nette\DI\Container from DI instead of main cleaner
- Renamed main Cleaner to CacheCleaner
- Symfony/Console is now required for it's NullOutput. Usage without console remains unchanged.

## [1.0.1] - 2018-03-02
### Fixed
- OpcodeCleaner failed when opcache_reset() call was restricted by Zend OPcode API directive "restrict_api"

## [1.0.0] - 2018-02-25
### Added
- Extendable (main) CacheCleaner (via ICleaner)
- Symfony/Console intergration
- Nette/DI container integration
- Pluggable cleaners
    - ApcCleaner
    - ApcuCleaner
    - LocalFilesystemCleaner
    - MemcacheCleaner
    - MemcachedCleaner
    - NetteCachingStorageCleaner
    - OpcodeCleaner
