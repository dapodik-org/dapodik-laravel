<?php

use Dapodik\Laravel\Eloquent\EloquentManager;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    Config::set('database.default', 'testing');

    $this->migrationsPath = database_path('migrations/dapodik');

    File::ensureDirectoryExists($this->migrationsPath);

    $existing = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
    foreach ($existing as $file) {
        File::delete($file);
    }

    app()->forgetInstance('dapodik.eloquent.laravel');
});

afterEach(function () {
    $existing = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
    foreach ($existing as $file) {
        File::delete($file);
    }
});

it('returns false for use split connection when split connection config is false', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $this->assertFalse($manager->useSplitConnection());
});

it('returns true for use split connection when split connection config is true', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['split_connection'] = true;
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $this->assertTrue($manager->useSplitConnection());
});

it('returns the driver name', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $this->assertEquals('sqlite', $manager->getDriverName());
});

it('returns the connection name', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $this->assertEquals('testing', $manager->getConnectionName());
});

it('returns empty connections array when split connection config is false', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $this->assertEquals([], $manager->getConnections());
});

it('returns connections when split connection config is true', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['split_connection'] = true;
    $config['connection'] = 'testing';
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $this->assertNotEmpty($manager->getConnections());
});

it('clones the base connection from the default when the configured connection does not exist', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['connection'] = 'custom_dapodik';
    $config['split_connection'] = false;
    config()->set('dapodik-eloquent', $config);

    $this->assertFalse(Config::has('database.connections.custom_dapodik'));

    $manager = new EloquentManager(app());

    $this->assertTrue(Config::has('database.connections.custom_dapodik'));
    $this->assertEquals('custom_dapodik', $manager->getConnectionName());
});

it('returns config array from get config', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $result = $manager->getConfig();
    $this->assertArrayHasKey('prefix', $result);
    $this->assertArrayHasKey('suffix', $result);
    $this->assertArrayHasKey('connection', $result);
    $this->assertArrayHasKey('split_connection', $result);
    $this->assertArrayHasKey('skip_fresh', $result);
    $this->assertArrayHasKey('exclude_tables', $result);
    $this->assertEquals('dapodik', $result['prefix']);
    $this->assertNull($result['connection']);
    $this->assertFalse($result['split_connection']);
    $this->assertFalse($result['skip_fresh']);
});

it('throws exception when prefix config is missing', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Missing required configuration key: 'prefix'");

    config()->set('dapodik-eloquent', [
        'suffix' => null,
        'connection' => null,
        'split_connection' => false,
    ]);
    new EloquentManager(app());
});

it('throws exception when split connection config has invalid type', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Invalid config type for 'split_connection'");

    config()->set('dapodik-eloquent', [
        'prefix' => 'dapodik',
        'suffix' => null,
        'connection' => 'dapodik',
        'split_connection' => 'invalid_boolean_string',
    ]);
    new EloquentManager(app());
});

it('does nothing when drop all tables called with no connections', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $this->assertEquals([], $manager->getConnections());
    $manager->dropAllTables();
    $this->assertTrue(true);
});

it('lists supported database drivers', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $ref = new ReflectionMethod($manager, 'supportedDrivers');
    $ref->setAccessible(true);
    $this->assertEquals(['mysql', 'mariadb', 'pgsql', 'sqlsrv', 'sqlite'], $ref->invoke($manager));
});

it('returns configured connection name from get connection name', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['connection'] = 'dapodik';
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $this->assertEquals('dapodik', $manager->getConnectionName());
});

it('returns default connection name from get connection name when config is null', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['connection'] = null;
    config()->set('dapodik-eloquent', $config);
    $manager = new EloquentManager(app());
    $this->assertEquals(config('database.default'), $manager->getConnectionName());
});

it('throws exception when connection config is not string or null', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Invalid config type for 'connection'");

    config()->set('dapodik-eloquent', [
        'prefix' => 'dapodik',
        'suffix' => null,
        'connection' => false,
        'split_connection' => false,
    ]);
    new EloquentManager(app());
});

it('throws exception when suffix config type is invalid', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Invalid config type for 'suffix'");

    config()->set('dapodik-eloquent', [
        'prefix' => 'dapodik',
        'suffix' => 123,
        'connection' => null,
        'split_connection' => false,
    ]);
    new EloquentManager(app());
});

it('throws exception when prefix config type is invalid', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Invalid config type for 'prefix'");

    config()->set('dapodik-eloquent', [
        'prefix' => false,
        'suffix' => null,
        'connection' => null,
        'split_connection' => false,
    ]);
    new EloquentManager(app());
});
