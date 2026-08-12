# Changelog

## Unreleased


## 1.0.8 - 2026-08-12

## What's Changed

### Added
- feat: add relationships to various models for error types and other references
## 1.0.7 - 2026-08-02

## What's Changed

### Added
- feat: add auto-load migrations feature and update documentation
## 1.0.6 - 2026-08-02

## What's Changed

### Added
- feat: add migration files to include asal_data and parent_rombongan_belajar_id fields
## 1.0.5 - 2026-07-22

## What's Changed

### Added
- feat: add command to publish Eloquent migration stubs and update README
## 1.0.4 - 2026-07-22

## What's Changed

### Added
- feat: update migration files to make several fields nullable across various tables

### Changed
- add git rules to AGENTS.md
## 1.0.3 - 2026-07-21

## What's Changed

### Added
- feat: add migration files to fix nullable fields and primary keys in various models
## 1.0.2 - 2026-07-21

## What's Changed

### Added
- feat: add FlagData and JenisFlag models with migrations, and update Author model namespace

### Fixed
- fix: allow compatibility with Guzzle 8.0 in composer.json
## 1.0.1 - 2026-07-15

## What's Changed

### Fixed
- fix: prevent unnecessary namespace prefixing for empty directory paths
## 1.0.0 - 2026-07-14

## What's Changed

### Added
- feat: add last tag detection for change detection in release workflow
- feat: enhance release workflow to determine and checkout appropriate branch
- feat: create release on monorepo as well
- feat: auto-skip sub-packages without changes since last tag
- feat: create releases on sub-packages instead of mono repo

### Changed
- Update CHANGELOG.md
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
- fix: push tag & release directly from release.yml to sub-packages
- fix: pull --rebase before push changelog to avoid non-fast-forward
- fix: use SPLIT_TOKEN for tag push to trigger split workflow
- fix: handle non-empty repos when creating target branch for split
- fix: use dynamic target branch in split.yml (fixes 1.x split)

All notable changes to this project will be documented in this file.
