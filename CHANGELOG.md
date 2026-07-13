# Changelog

## Unreleased


## 1.0.0 - 2026-07-13

## What's Changed

### Fixed
- fix: use SPLIT_TOKEN for tag push to trigger split workflow
## 1.0.0 - 2026-07-13

## What's Changed

### Added
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
- fix: handle non-empty repos when creating target branch for split
- fix: use dynamic target branch in split.yml (fixes 1.x split)
## 1.0.0 - 2026-07-13

## What's Changed

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
- fix: handle non-empty repos when creating target branch for split
- fix: use dynamic target branch in split.yml (fixes 1.x split)

All notable changes to this project will be documented in this file.
