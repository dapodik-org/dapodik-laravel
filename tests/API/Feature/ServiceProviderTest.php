<?php

namespace Dapodik\Laravel\API\Tests\Feature;

use Dapodik\Laravel\API\APIManager;
use Dapodik\Laravel\API\Facades\API;
use Dapodik\Laravel\API\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_api_manager_as_singleton()
    {
        $instance1 = $this->app->make('dapodik.api.laravel');
        $instance2 = $this->app->make('dapodik.api.laravel');

        $this->assertSame($instance1, $instance2);
        $this->assertInstanceOf(APIManager::class, $instance1);
    }

    /** @test */
    public function it_merges_config_from_package()
    {
        $default = $this->app['config']->get('dapodik-api.default');
        $connections = $this->app['config']->get('dapodik-api.connections');

        $this->assertEquals('authentication', $default);
        $this->assertArrayHasKey('authentication', $connections);
        $this->assertArrayHasKey('authorization', $connections);
    }

    /** @test */
    public function facade_accessor_is_correct()
    {
        $reflection = new \ReflectionMethod(API::class, 'getFacadeAccessor');
        $reflection->setAccessible(true);

        $this->assertEquals('dapodik.api.laravel', $reflection->invoke(null));
    }
}
