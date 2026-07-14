<?php

use Dapodik\Laravel\API\APIManager;
use Dapodik\Laravel\API\Facades\API;

it('registers api manager as singleton', function () {
    $instance1 = $this->app->make('dapodik.api.laravel');
    $instance2 = $this->app->make('dapodik.api.laravel');

    $this->assertSame($instance1, $instance2);
    $this->assertInstanceOf(APIManager::class, $instance1);
});

it('merges config from package', function () {
    $default = $this->app['config']->get('dapodik-api.default');
    $connections = $this->app['config']->get('dapodik-api.connections');

    $this->assertEquals('authentication', $default);
    $this->assertArrayHasKey('authentication', $connections);
    $this->assertArrayHasKey('authorization', $connections);
});

it('facade accessor is correct', function () {
    $reflection = new ReflectionMethod(API::class, 'getFacadeAccessor');
    $reflection->setAccessible(true);

    $this->assertEquals('dapodik.api.laravel', $reflection->invoke(null));
});
