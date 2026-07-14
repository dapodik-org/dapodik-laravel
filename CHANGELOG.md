# Changelog

## Unreleased


## 2.1.0 - 2026-07-14

## What's Changed

### Added
- feat: add new enum types for educational entities and refactor test cases

### Fixed
- fix: update PHP versions in test matrix and add bootstrap file for error handling
## 2.0.0 - 2026-07-14

## What's Changed

### Added
- feat: create release on monorepo as well
- feat: auto-skip sub-packages without changes since last tag
- feat: create releases on sub-packages instead of mono repo

### Changed
- perbaiki README dan gitignore
- Fix split.yml: set user name and email for GitHub Actions
- Fix TestCase.php: check for method existence before calling defineEnvironment
- Fix split.yml: streamline initialization of empty repositories using GitHub API
- Revert global bootstrap to fix prefer-lowest tests
- Fix split.yml: use SPLIT_TOKEN directly in git push URL
- Fix split.yml: use output check for empty repo, ensure main branch
- update GitHub Actions workflows to create main branch and disable fail-fast
- refactor GitHub Actions workflows and enhance PHPUnit configuration
- update GitHub Actions to use checkout@v7 and php-cs-fixer

### Fixed
- fix: add logic to save last tag for change detection in release workflow
- fix: add logic to determine and checkout the appropriate release branch
- fix: update release and split workflows for version tagging and branch support
- fix: add missing spaces for code style consistency
- fix: allow pestphp/pest version 3.0 for compatibility with newer features
- fix: update doctrine/dbal to ^3.5 for compatibility improvements
- fix: doctrine/dbal ^3.3 (^3.2 lacks introspectTable)
- fix: doctrine/dbal ^3.2 (^3.0 lacks createSchemaManager)
- fix: add doctrine/dbal ^3.0 to require-dev — needed by Laravel 9 for dropColumn on SQLite
- fix: drop Laravel 9 from CI (Pest 2 incompatible), remove collision from require-dev (pulled by testbench), fix --dev flag
- fix: test matrix — drop PHP 8.1, add excludes, conditional pest-plugin-laravel, add allow-plugins
- fix: push tag & release directly from release.yml to sub-packages
- fix: pull --rebase before push changelog to avoid non-fast-forward
- fix: use SPLIT_TOKEN for tag push to trigger split workflow
- fix: handle non-empty repos when creating target branch for split
- fix: use dynamic target branch in split.yml

### Docs
- docs: simplify AGENTS.md table — use 'or' instead of escaped pipes
- docs: update AGENTS.md — drop Laravel 9 from CI matrix

All notable changes to this project will be documented in this file.
