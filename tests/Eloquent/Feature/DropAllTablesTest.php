<?php

use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

    Config::set('database.connections.sqlite', [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
        'foreign_key_constraints' => true,
    ]);
    Config::set('database.default', 'sqlite');

    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['split_connection'] = true;
    $config['exclude_tables'] = [];
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');
});

function getTableNames($connection): array
{
    return DB::connection($connection)->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
}

it('drops all tables from all connections when connection config is enabled', function () {
    $this->artisan('migrate')->assertExitCode(0);

    $connections = app('dapodik.eloquent.laravel')->getConnections();
    foreach ($connections as $connection) {
        $tables = getTableNames($connection);
        $this->assertNotEmpty($tables, "Connection {$connection} should have tables after migrate");
    }

    app('dapodik.eloquent.laravel')->dropAllTables();

    foreach ($connections as $connection) {
        $tables = getTableNames($connection);
        $this->assertEmpty($tables, "Connection {$connection} should have no tables after dropAllTables");
    }
});

it('migrate fresh recreates tables after drop via event listener', function () {
    $this->artisan('migrate')->assertExitCode(0);

    $connection = app(Agama::class)->getConnectionName();
    $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_agama'));

    $this->artisan('migrate:fresh')->assertExitCode(0);

    $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_agama'));
    $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_akreditasi'));

    $connections = app('dapodik.eloquent.laravel')->getConnections();
    foreach ($connections as $connection) {
        $tables = getTableNames($connection);
        $this->assertNotEmpty($tables, "Connection {$connection} should have tables after migrate:fresh");
    }
});

it('skip fresh preserves dapodik tables on migrate fresh', function () {
    $config = config('dapodik-eloquent');
    $config['skip_fresh'] = true;
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $this->artisan('migrate')->assertExitCode(0);

    $connection = app(Agama::class)->getConnectionName();
    $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_agama'));

    $this->artisan('migrate:fresh')->assertExitCode(0);

    $this->assertTrue(
        Schema::connection($connection)->hasTable('dapodik_ref_agama'),
        'dapodik tables should be preserved when skip_fresh is true'
    );

    $connections = app('dapodik.eloquent.laravel')->getConnections();
    foreach ($connections as $connection) {
        $tables = getTableNames($connection);
        $this->assertNotEmpty($tables, "Connection {$connection} should still have tables when skip_fresh is true");
    }
});
