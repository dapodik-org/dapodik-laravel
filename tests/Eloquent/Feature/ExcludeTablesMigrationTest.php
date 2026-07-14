<?php

use Dapodik\Laravel\Eloquent\Models\Ref\Akreditasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

beforeEach(function () {
    $migrationsPath = $this->app->databasePath('migrations/dapodik');
    if (! is_dir($migrationsPath)) {
        mkdir($migrationsPath, 0755, true);
    }
    $sourcePath = realpath(__DIR__.'/../../../src/laravel/Eloquent/database/migrations/dapodik');
    foreach (glob($sourcePath.'/*.php') as $file) {
        $dest = $migrationsPath.'/'.basename($file);
        copy($file, $dest);
    }
    $config = $this->app['config']->get('dapodik-eloquent', []);
    $config['exclude_tables'] = [];
    $this->app['config']->set('dapodik-eloquent', $config);

    $this->migrationsPath = database_path('migrations/dapodik');
});

function removeExcludedMigrationFiles(string $migrationsPath, array $excludeTables): void
{
    if (empty($excludeTables)) {
        return;
    }

    $migrationModelMap = [
        'create_dapodik_akreditasi_table' => ['table' => 'akreditasi', 'table_full' => 'dapodik_ref_akreditasi', 'model' => Akreditasi::class],
        'create_dapodik_sekolah_table' => ['table' => 'sekolah', 'table_full' => 'dapodik_sekolah', 'model' => ''],
        'create_dapodik_agama_table' => ['table' => 'agama', 'table_full' => 'dapodik_ref_agama', 'model' => ''],
        'create_dapodik_sync_log_table' => ['table' => 'sync_log', 'table_full' => 'dapodik_sync_log', 'model' => ''],
        'create_dapodik_sync_primer_table' => ['table' => 'sync_primer', 'table_full' => 'dapodik_sync_primer', 'model' => ''],
        'create_dapodik_sync_session_table' => ['table' => 'sync_session', 'table_full' => 'dapodik_sync_session', 'model' => ''],
        'create_dapodik_table_sync_log_table' => ['table' => 'table_sync_log', 'table_full' => 'dapodik_table_sync_log', 'model' => ''],
    ];

    $files = glob($migrationsPath.'/*_create_dapodik_*_table.php');

    foreach ($files as $filePath) {
        $basename = basename($filePath);
        $basenameNoTimestamp = preg_replace('/^\d{4}_\d{2}_\d{2}_\d{6}_/', '', $basename);
        $basenameNoExt = str_replace('.php', '', $basenameNoTimestamp);

        $info = isset($migrationModelMap[$basenameNoExt]) ? $migrationModelMap[$basenameNoExt] : null;

        foreach ($excludeTables as $excluded) {
            $isRegex = Str::startsWith($excluded, '/') && Str::endsWith($excluded, '/');

            if ($isRegex) {
                if (preg_match($excluded, $basenameNoExt)) {
                    @unlink($filePath);

                    continue 2;
                }
                if ($info !== null && (preg_match($excluded, $info['table']) || preg_match($excluded, $info['table_full']) || preg_match($excluded, $info['model']))) {
                    @unlink($filePath);

                    continue 2;
                }
            } else {
                if ($basenameNoExt === $excluded) {
                    @unlink($filePath);

                    continue 2;
                }
                if ($info !== null && ($info['table'] === $excluded || $info['table_full'] === $excluded || $info['model'] === $excluded)) {
                    @unlink($filePath);

                    continue 2;
                }
            }
        }
    }
}

function countMigrationFiles(string $migrationsPath, string $pattern = '*'): int
{
    return count(glob($migrationsPath.'/*_create_dapodik_'.$pattern.'_table.php'));
}

function assertTableExists(string $table): void
{
    expect(Schema::hasTable($table))->toBeTrue();
}

function assertTableMissing(string $table): void
{
    expect(Schema::hasTable($table))->toBeFalse();
}

it('skips creating excluded tables configured by full table name', function () {
    removeExcludedMigrationFiles($this->migrationsPath, ['dapodik_ref_akreditasi']);
    $this->artisan('migrate')->assertExitCode(0);

    assertTableExists('dapodik_ref_agama');
    assertTableMissing('dapodik_ref_akreditasi');
});

it('skips creating excluded tables configured by model key name', function () {
    removeExcludedMigrationFiles($this->migrationsPath, ['akreditasi']);
    $this->artisan('migrate')->assertExitCode(0);

    assertTableExists('dapodik_ref_agama');
    assertTableMissing('dapodik_ref_akreditasi');
});

it('skips creating excluded tables configured by fully qualified class name', function () {
    removeExcludedMigrationFiles($this->migrationsPath, [Akreditasi::class]);
    $this->artisan('migrate')->assertExitCode(0);

    assertTableExists('dapodik_ref_agama');
    assertTableMissing('dapodik_ref_akreditasi');
});

it('skips creating multiple excluded tables', function () {
    removeExcludedMigrationFiles($this->migrationsPath, ['akreditasi', 'sync_log', 'sync_primer', 'sync_session', 'table_sync_log']);
    $this->artisan('migrate')->assertExitCode(0);

    assertTableExists('dapodik_ref_agama');
    assertTableMissing('dapodik_ref_akreditasi');
    assertTableMissing('dapodik_sync_log');
});

it('runs all migrations when exclude tables is empty', function () {
    $this->artisan('migrate')->assertExitCode(0);

    assertTableExists('dapodik_ref_agama');
    assertTableExists('dapodik_ref_akreditasi');
});

it('skips excluded tables using regex pattern on migration filename', function () {
    removeExcludedMigrationFiles($this->migrationsPath, ['/^create_dapodik_sync/']);
    $this->artisan('migrate')->assertExitCode(0);

    assertTableExists('dapodik_ref_agama');
    assertTableMissing('dapodik_sync_log');
    assertTableMissing('dapodik_sync_primer');
});

it('skips excluded tables using regex pattern on table key', function () {
    removeExcludedMigrationFiles($this->migrationsPath, ['/^sync_/']);
    $this->artisan('migrate')->assertExitCode(0);

    assertTableExists('dapodik_ref_agama');
    assertTableMissing('dapodik_sync_log');
});

it('does not register excluded migration in migrations table', function () {
    removeExcludedMigrationFiles($this->migrationsPath, ['akreditasi']);
    $this->artisan('migrate')->assertExitCode(0);

    $migrations = DB::table('migrations')->pluck('migration')->toArray();
    $this->assertNotEmpty($migrations);

    $akreditasiMigrations = array_filter($migrations, function ($m) {
        return (bool) preg_match('/_create_dapodik_akreditasi_table$/', $m);
    });
    $this->assertEmpty($akreditasiMigrations);
});
