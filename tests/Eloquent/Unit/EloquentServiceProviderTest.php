<?php

use Dapodik\Laravel\Eloquent\EloquentManager;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    $this->migrationsPath = database_path('migrations/dapodik');

    File::ensureDirectoryExists($this->migrationsPath);

    $existing = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
    foreach ($existing as $file) {
        File::delete($file);
    }
});

afterEach(function () {
    $existing = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
    foreach ($existing as $file) {
        File::delete($file);
    }
});

it('registers the dapodik eloquent laravel singleton', function () {
    $instance = app('dapodik.eloquent.laravel');
    $this->assertInstanceOf(EloquentManager::class, $instance);

    $instance2 = app('dapodik.eloquent.laravel');
    $this->assertSame($instance2, $instance);
});

it('publishes the config file', function () {
    $this->artisan('vendor:publish', ['--tag' => 'dapodik-eloquent-config'])
        ->assertExitCode(0);

    $this->assertNull(config('dapodik-eloquent.connection'));
});

it('publishes migrations', function () {
    $this->artisan('vendor:publish', ['--tag' => 'dapodik-eloquent-migrations'])
        ->assertExitCode(0);

    $files = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
    $this->assertNotEmpty($files);
});

it('does not drop tables on non migrate fresh commands', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['split_connection'] = true;
    $config['connection'] = 'testing';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $this->artisan('migrate')->assertExitCode(0);

    $connections = app('dapodik.eloquent.laravel')->getConnections();
    $this->assertNotEmpty($connections);
});
