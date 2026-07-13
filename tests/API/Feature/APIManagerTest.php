<?php

namespace Dapodik\Laravel\API\Tests\Feature;

use Dapodik\Laravel\API\APIManager;
use Dapodik\Laravel\API\Connection;
use Dapodik\Laravel\API\Facades\API;
use Dapodik\Laravel\API\Tests\TestCase;

class APIManagerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('dapodik-api.default', 'webservice');
        $this->app['config']->set('dapodik-api.connections.webservice', [
            'host' => 'http://localhost:5774',
            'npsn' => '12345678',
            'token' => 'test-token',
            'driver' => 'webservice',
        ]);
    }

    /** @test */
    public function it_resolves_default_connection_from_config()
    {
        $manager = $this->app->make('dapodik.api.laravel');

        $this->assertInstanceOf(APIManager::class, $manager);
        $this->assertEquals('webservice', $manager->getDefaultConnection());
    }

    /** @test */
    public function it_creates_connection_from_manager()
    {
        $manager = $this->app->make('dapodik.api.laravel');

        $connection = $manager->connection('webservice');

        $this->assertInstanceOf(Connection::class, $connection);
    }

    /** @test */
    public function it_throws_for_missing_connection_config()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Connection [nonexistent] not configured.');

        $manager = $this->app->make('dapodik.api.laravel');
        $manager->connection('nonexistent');
    }

    /** @test */
    public function it_uses_default_connection_when_no_name_given()
    {
        $manager = $this->app->make('dapodik.api.laravel');

        $connection = $manager->connection();

        $this->assertInstanceOf(Connection::class, $connection);
    }

    /** @test */
    public function it_supports_macro_calls()
    {
        APIManager::macro('customMethod', function() {
            return 'macro result';
        });

        $manager = $this->app->make('dapodik.api.laravel');

        $this->assertEquals('macro result', $manager->customMethod());
    }

    /** @test */
    public function facade_returns_manager_instance()
    {
        $facade = API::getFacadeRoot();

        $this->assertInstanceOf(APIManager::class, $facade);
        $this->assertEquals('webservice', API::getDefaultConnection());
    }
}
