#!/usr/bin/env php
<?php

$version = $argv[1] ?? '';
$tag = ltrim($version, 'v');
$date = gmdate('Y-m-d');

$changelogFile = __DIR__.'/../CHANGELOG.md';
$lines = file($changelogFile, FILE_IGNORE_NEW_LINES);

$unreleasedStart = null;
$nextSectionStart = null;

foreach ($lines as $i => $line) {
    if (preg_match('/^## Unreleased$/', $line)) {
        $unreleasedStart = $i;
    } elseif ($unreleasedStart !== null && preg_match('/^## /', $line)) {
        $nextSectionStart = $i;
        break;
    }
}

// Extract release body from the Unreleased section content
$releaseBody = '';
if ($unreleasedStart !== null) {
    $end = $nextSectionStart ?? count($lines);
    $bodyLines = array_slice($lines, $unreleasedStart + 1, $end - $unreleasedStart - 1);
    $bodyContent = trim(implode("\n", $bodyLines));
    if ($bodyContent !== '') {
        $releaseBody = "## What's Changed\n\n$bodyContent\n";
    }
}

file_put_contents('/tmp/release-body.md', $releaseBody);

// Replace ## Unreleased with version entry
if ($unreleasedStart !== null) {
    $end = $nextSectionStart ?? count($lines);
    $releaseEntry = "## $tag - $date\n";
    if ($releaseBody !== '') {
        $releaseEntry .= "\n$releaseBody";
    }
    array_splice($lines, $unreleasedStart, $end - $unreleasedStart, explode("\n", rtrim($releaseEntry)));
}

// Prepend new empty ## Unreleased after # Changelog header
$headerIdx = null;
foreach ($lines as $i => $line) {
    if (preg_match('/^# Changelog$/', $line)) {
        $headerIdx = $i + 1;
        break;
    }
}
array_splice($lines, $headerIdx ?? 1, 0, ['', '## Unreleased', '']);

file_put_contents($changelogFile, implode("\n", $lines)."\n");
echo "CHANGELOG.md updated for release $version.\n";
