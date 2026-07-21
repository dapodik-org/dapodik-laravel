<?php

namespace Dapodik\Laravel\Eloquent\Tests\Unit;

use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\File;

class EloquentServiceProviderTest extends TestCase
{
    private $migrationsPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->migrationsPath = database_path('migrations/dapodik');

        File::ensureDirectoryExists($this->migrationsPath);

        $existing = glob($this->migrationsPath.'/*.php');
        foreach ($existing as $file) {
            File::delete($file);
        }
    }

    protected function tearDown(): void
    {
        $existing = glob($this->migrationsPath.'/*.php');
        foreach ($existing as $file) {
            File::delete($file);
        }

        parent::tearDown();
    }

    /** @test */
    public function registers_the_dapodik_eloquent_laravel_singleton()
    {
        $instance = app('dapodik.eloquent.laravel');
        $this->assertInstanceOf(EloquentManager::class, $instance);

        $instance2 = app('dapodik.eloquent.laravel');
        $this->assertSame($instance2, $instance);
    }

    /** @test */
    public function publishes_the_config_file()
    {
        $this->artisan('vendor:publish', ['--tag' => 'dapodik-eloquent-config'])
            ->assertExitCode(0);

        $this->assertNull(config('dapodik-eloquent.connection'));
    }

    /** @test */
    public function publishes_migrations()
    {
        $this->artisan('vendor:publish', ['--tag' => 'dapodik-eloquent-migrations'])
            ->assertExitCode(0);

        $files = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
        $this->assertNotEmpty($files);
    }

    /** @test */
    public function does_not_drop_tables_on_non_migrate_fresh_commands()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['split_connection'] = true;
        $config['connection'] = 'testing';
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $this->artisan('migrate')->assertExitCode(0);

        $connections = app('dapodik.eloquent.laravel')->getConnections();
        $this->assertNotEmpty($connections);
    }
}
