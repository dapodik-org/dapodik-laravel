#!/usr/bin/env php
<?php

$changelogFile = __DIR__ . '/../CHANGELOG.md';

exec('git describe --tags --abbrev=0 2>/dev/null', $output, $code);
if ($code !== 0 || !isset($output[0])) {
    exec('git rev-list --max-parents=0 HEAD', $output, $code);
}
$prev = $output[0] ?? 'HEAD';

$commits = [];
exec(sprintf('git log "%s"..HEAD --pretty=format:"- %%s" --no-merges 2>/dev/null', $prev), $commits);

$categories = [
    '### Added'   => [],
    '### Changed' => [],
    '### Fixed'   => [],
    '### Removed' => [],
    '### Docs'    => [],
];

foreach ($commits as $commit) {
    $msg = preg_replace('/^- /', '', trim($commit));

    if (preg_match('/^feat(?:ure)?[:\(]/i', $msg)) {
        $categories['### Added'][] = $msg;
    } elseif (preg_match('/^fix[:\(]/i', $msg)) {
        $categories['### Fixed'][] = $msg;
    } elseif (preg_match('/^refactor[:\(]/i', $msg)) {
        $categories['### Changed'][] = $msg;
    } elseif (preg_match('/^docs[:\(]/i', $msg)) {
        $categories['### Docs'][] = $msg;
    } elseif (preg_match('/^(chore|build|ci|style|test|perf)[:\(]/i', $msg)) {
        continue;
    } elseif (preg_match('/^Fix styling$/i', $msg)) {
        continue;
    } else {
        $categories['### Changed'][] = $msg;
    }
}

$unreleased = "## Unreleased\n";
foreach ($categories as $header => $items) {
    if ($items !== []) {
        $unreleased .= "\n$header\n";
        foreach ($items as $item) {
            $unreleased .= "- $item\n";
        }
    }
}

$unreleased .= "\n";

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

if ($unreleasedStart !== null) {
    $end = $nextSectionStart ?? count($lines);
    array_splice($lines, $unreleasedStart, $end - $unreleasedStart, explode("\n", rtrim($unreleased)));
} else {
    $headerIdx = null;
    foreach ($lines as $i => $line) {
        if (preg_match('/^# Changelog$/', $line)) {
            $headerIdx = $i + 1;
            break;
        }
    }
    array_splice($lines, $headerIdx ?? 1, 0, ['', ...explode("\n", rtrim($unreleased))]);
}

file_put_contents($changelogFile, implode("\n", $lines));
echo "CHANGELOG.md updated.\n";
