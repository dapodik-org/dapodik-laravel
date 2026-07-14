<?php

namespace Dapodik\Laravel\Eloquent\Tests\Unit;

use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use InvalidArgumentException;

class EloquentManagerTest extends TestCase
{
    private $migrationsPath;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('database.default', 'testing');

        $this->migrationsPath = database_path('migrations/dapodik');

        File::ensureDirectoryExists($this->migrationsPath);

        $existing = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
        foreach ($existing as $file) {
            File::delete($file);
        }

        app()->forgetInstance('dapodik.eloquent.laravel');
    }

    protected function tearDown(): void
    {
        $existing = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
        foreach ($existing as $file) {
            File::delete($file);
        }

        parent::tearDown();
    }

    /** @test */
    public function returns_false_for_use_split_connection_when_split_connection_config_is_false()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $this->assertFalse($manager->useSplitConnection());
    }

    /** @test */
    public function returns_true_for_use_split_connection_when_split_connection_config_is_true()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['split_connection'] = true;
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $this->assertTrue($manager->useSplitConnection());
    }

    /** @test */
    public function returns_the_driver_name()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $this->assertEquals('sqlite', $manager->getDriverName());
    }

    /** @test */
    public function returns_the_connection_name()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $this->assertEquals('testing', $manager->getConnectionName());
    }

    /** @test */
    public function returns_empty_connections_array_when_split_connection_config_is_false()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $this->assertEquals([], $manager->getConnections());
    }

    /** @test */
    public function returns_connections_when_split_connection_config_is_true()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['split_connection'] = true;
        $config['connection'] = 'testing';
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $this->assertNotEmpty($manager->getConnections());
    }

    /** @test */
    public function clones_the_base_connection_from_the_default_when_the_configured_connection_does_not_exist()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['connection'] = 'custom_dapodik';
        $config['split_connection'] = false;
        config()->set('dapodik-eloquent', $config);

        $this->assertFalse(Config::has('database.connections.custom_dapodik'));

        $manager = new EloquentManager(app());

        $this->assertTrue(Config::has('database.connections.custom_dapodik'));
        $this->assertEquals('custom_dapodik', $manager->getConnectionName());
    }

    /** @test */
    public function returns_config_array_from_get_config()
    {
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
    }

    /** @test */
    public function throws_exception_when_prefix_config_is_missing()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Missing required configuration key: 'prefix'");

        config()->set('dapodik-eloquent', [
            'suffix' => null,
            'connection' => null,
            'split_connection' => false,
        ]);
        new EloquentManager(app());
    }

    /** @test */
    public function throws_exception_when_split_connection_config_has_invalid_type()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid config type for 'split_connection'");

        config()->set('dapodik-eloquent', [
            'prefix' => 'dapodik',
            'suffix' => null,
            'connection' => 'dapodik',
            'split_connection' => 'invalid_boolean_string',
        ]);
        new EloquentManager(app());
    }

    /** @test */
    public function does_nothing_when_drop_all_tables_called_with_no_connections()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $this->assertEquals([], $manager->getConnections());
        $manager->dropAllTables();
        $this->assertTrue(true);
    }

    /** @test */
    public function lists_supported_database_drivers()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $ref = new \ReflectionMethod($manager, 'supportedDrivers');
        $ref->setAccessible(true);
        $this->assertEquals(['mysql', 'mariadb', 'pgsql', 'sqlsrv', 'sqlite'], $ref->invoke($manager));
    }

    /** @test */
    public function returns_configured_connection_name_from_get_connection_name()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['connection'] = 'dapodik';
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $this->assertEquals('dapodik', $manager->getConnectionName());
    }

    /** @test */
    public function returns_default_connection_name_from_get_connection_name_when_config_is_null()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['connection'] = null;
        config()->set('dapodik-eloquent', $config);
        $manager = new EloquentManager(app());
        $this->assertEquals(config('database.default'), $manager->getConnectionName());
    }

    /** @test */
    public function throws_exception_when_connection_config_is_not_string_or_null()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid config type for 'connection'");

        config()->set('dapodik-eloquent', [
            'prefix' => 'dapodik',
            'suffix' => null,
            'connection' => false,
            'split_connection' => false,
        ]);
        new EloquentManager(app());
    }

    /** @test */
    public function throws_exception_when_suffix_config_type_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid config type for 'suffix'");

        config()->set('dapodik-eloquent', [
            'prefix' => 'dapodik',
            'suffix' => 123,
            'connection' => null,
            'split_connection' => false,
        ]);
        new EloquentManager(app());
    }

    /** @test */
    public function throws_exception_when_prefix_config_type_is_invalid()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid config type for 'prefix'");

        config()->set('dapodik-eloquent', [
            'prefix' => false,
            'suffix' => null,
            'connection' => null,
            'split_connection' => false,
        ]);
        new EloquentManager(app());
    }
}
