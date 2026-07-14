<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\Facades\Eloquent;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class MigrateConnectionTest extends TestCase
{
    private $migrationsPath;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);
        Config::set('database.default', 'sqlite');

        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['split_connection'] = true;
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function ($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $this->migrationsPath = database_path('migrations/dapodik');

        File::ensureDirectoryExists($this->migrationsPath);

        $existing = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
        foreach ($existing as $file) {
            File::delete($file);
        }

        $this->artisan('vendor:publish', ['--tag' => 'dapodik-eloquent-migrations'])
            ->assertExitCode(0);
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
    public function creates_tables_on_model_connection_enabled()
    {
        $this->assertTrue(Eloquent::useSplitConnection());

        $this->artisan('migrate')->assertExitCode(0);

        $connection = app(Agama::class)->getConnectionName();
        $this->assertEquals('sqlite_ref', $connection);

        $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_agama'));
        $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_akreditasi'));
    }

    /** @test */
    public function drops_and_recreates_tables_via_migrate_fresh_with_connection()
    {
        $this->artisan('migrate')->assertExitCode(0);

        $connection = app(Agama::class)->getConnectionName();
        $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_agama'));

        $this->artisan('migrate:fresh')->assertExitCode(0);

        $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_agama'));
        $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_akreditasi'));
    }
}
