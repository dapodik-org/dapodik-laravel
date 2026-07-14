<?php

use Dapodik\Laravel\API\APIManager;
use Dapodik\Laravel\API\Connection;
use Dapodik\Laravel\API\Facades\API;

beforeEach(function () {
    $this->app['config']->set('dapodik-api.default', 'webservice');
    $this->app['config']->set('dapodik-api.connections.webservice', [
        'host' => 'http://localhost:5774',
        'npsn' => '12345678',
        'token' => 'test-token',
        'driver' => 'webservice',
    ]);
});

it('resolves default connection from config', function () {
    $manager = $this->app->make('dapodik.api.laravel');

    $this->assertInstanceOf(APIManager::class, $manager);
    $this->assertEquals('webservice', $manager->getDefaultConnection());
});

it('creates connection from manager', function () {
    $manager = $this->app->make('dapodik.api.laravel');

    $connection = $manager->connection('webservice');

    $this->assertInstanceOf(Connection::class, $connection);
});

it('throws for missing connection config', function () {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Connection [nonexistent] not configured.');

    $manager = $this->app->make('dapodik.api.laravel');
    $manager->connection('nonexistent');
});

it('uses default connection when no name given', function () {
    $manager = $this->app->make('dapodik.api.laravel');

    $connection = $manager->connection();

    $this->assertInstanceOf(Connection::class, $connection);
});

it('supports macro calls', function () {
    APIManager::macro('customMethod', function () {
        return 'macro result';
    });

    $manager = $this->app->make('dapodik.api.laravel');

    $this->assertEquals('macro result', $manager->customMethod());
});

it('facade returns manager instance', function () {
    $facade = API::getFacadeRoot();

    $this->assertInstanceOf(APIManager::class, $facade);
    $this->assertEquals('webservice', API::getDefaultConnection());
});
