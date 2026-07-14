<?php

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentDatabaseCreateCommand;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

it('verifies the database create command is available', function () {
    $this->assertTrue(class_exists(DapodikEloquentDatabaseCreateCommand::class));
});

it('creates a sqlite database file if it does not exist', function () {
    $dbPath = sys_get_temp_dir().'/dapodik-test-'.uniqid().'.sqlite';

    Config::set('dapodik-eloquent.connection', 'sqlite_test');
    Config::set('database.connections.sqlite_test', [
        'driver' => 'sqlite',
        'database' => $dbPath,
    ]);

    $this->artisan('dapodik:eloquent-db-create')
        ->assertExitCode(0);

    $this->assertTrue(File::exists($dbPath));

    File::delete($dbPath);
});

it('does not fail when sqlite database already exists', function () {
    $dbPath = sys_get_temp_dir().'/dapodik-test-'.uniqid().'.sqlite';
    touch($dbPath);

    Config::set('dapodik-eloquent.connection', 'sqlite_test2');
    Config::set('database.connections.sqlite_test2', [
        'driver' => 'sqlite',
        'database' => $dbPath,
    ]);

    $this->artisan('dapodik:eloquent-db-create')
        ->assertExitCode(0);

    File::delete($dbPath);
});

it('creates sqlite database with custom database option', function () {
    $dbPath = sys_get_temp_dir().'/dapodik-test-'.uniqid().'.sqlite';

    Config::set('dapodik-eloquent.connection', 'sqlite_test3');
    Config::set('database.connections.sqlite_test3', [
        'driver' => 'sqlite',
        'database' => ':memory:',
    ]);

    $this->artisan('dapodik:eloquent-db-create', [
        '--connection' => 'sqlite_test3',
        '--database' => $dbPath,
    ])->assertExitCode(0);

    $this->assertTrue(File::exists($dbPath));

    File::delete($dbPath);
});

it('fails when connection is not configured', function () {
    Config::set('dapodik-eloquent.connection', 'nonexistent_connection');

    $this->artisan('dapodik:eloquent-db-create')
        ->assertExitCode(1);
});

it('fails when no database name is specified', function () {
    Config::set('dapodik-eloquent.connection', 'no_db_conn');
    Config::set('database.connections.no_db_conn', [
        'driver' => 'mysql',
    ]);

    $this->artisan('dapodik:eloquent-db-create')
        ->assertExitCode(1);
});

it('creates sqlite database using relative path', function () {
    $dbName = 'dapodik-test-'.uniqid().'.sqlite';
    Config::set('dapodik-eloquent.connection', 'sqlite_rel');
    Config::set('database.connections.sqlite_rel', [
        'driver' => 'sqlite',
        'database' => $dbName,
    ]);

    $this->artisan('dapodik:eloquent-db-create')
        ->assertExitCode(0);

    $expectedPath = database_path(Config::get('database.connections.sqlite_rel.database'));
    $this->assertTrue(File::exists($expectedPath));

    File::delete($expectedPath);
});

it('creates sqlite database in subdirectory', function () {
    $dir = sys_get_temp_dir().'/dapodik-subdir-'.uniqid();
    $dbPath = $dir.'/test.sqlite';

    Config::set('dapodik-eloquent.connection', 'sqlite_sub');
    Config::set('database.connections.sqlite_sub', [
        'driver' => 'sqlite',
        'database' => $dbPath,
    ]);

    $this->artisan('dapodik:eloquent-db-create')
        ->assertExitCode(0);

    $this->assertTrue(File::exists($dbPath));

    File::deleteDirectory($dir);
});

it('creates all split sqlite databases', function () {
    $dir = sys_get_temp_dir().'/dapodik-split-'.uniqid();
    $dbPath = $dir.'/dapodik.sqlite';

    Config::set('dapodik-eloquent.split_connection', true);
    Config::set('dapodik-eloquent.connection', 'sqlite_split');
    Config::set('database.connections.sqlite_split', [
        'driver' => 'sqlite',
        'database' => $dbPath,
    ]);

    $this->artisan('dapodik:eloquent-db-create')
        ->assertExitCode(0);

    $this->assertTrue(File::exists($dbPath));

    $folders = ['ref', 'man_akses', 'pustaka', 'nilai', 'audit', 'blob', 'eloquent'];
    foreach ($folders as $folder) {
        $splitFile = $dir.'/dapodik_'.$folder.'.sqlite';
        $this->assertTrue(File::exists($splitFile));
    }

    File::deleteDirectory($dir);
});

it('does not fail when split sqlite databases already exist', function () {
    $dir = sys_get_temp_dir().'/dapodik-split-existing-'.uniqid();
    $dbPath = $dir.'/dapodik.sqlite';
    mkdir($dir, 0777, true);
    touch($dbPath);

    Config::set('dapodik-eloquent.split_connection', true);
    Config::set('dapodik-eloquent.connection', 'sqlite_split_existing');
    Config::set('database.connections.sqlite_split_existing', [
        'driver' => 'sqlite',
        'database' => $dbPath,
    ]);

    $this->artisan('dapodik:eloquent-db-create')
        ->assertExitCode(0);

    File::deleteDirectory($dir);
});
