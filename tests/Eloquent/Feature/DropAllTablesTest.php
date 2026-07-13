<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Dapodik\Laravel\Eloquent\Tests\CopiesMigrations;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DropAllTablesTest extends TestCase
{
    use CopiesMigrations;

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
        $config['exclude_tables'] = [];
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');
    }

    private function getTableNames($connection)
    {
        return DB::connection($connection)->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
    }

    /** @test */
    public function drops_all_tables_from_all_connections_when_connection_config_is_enabled()
    {
        $this->artisan('migrate')->assertExitCode(0);

        $connections = app('dapodik.eloquent.laravel')->getConnections();
        foreach ($connections as $connection) {
            $tables = $this->getTableNames($connection);
            $this->assertNotEmpty($tables, "Connection {$connection} should have tables after migrate");
        }

        app('dapodik.eloquent.laravel')->dropAllTables();

        foreach ($connections as $connection) {
            $tables = $this->getTableNames($connection);
            $this->assertEmpty($tables, "Connection {$connection} should have no tables after dropAllTables");
        }
    }

    /** @test */
    public function migrate_fresh_recreates_tables_after_drop_via_event_listener()
    {
        $this->artisan('migrate')->assertExitCode(0);

        $connection = app(Agama::class)->getConnectionName();
        $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_agama'));

        $this->artisan('migrate:fresh')->assertExitCode(0);

        $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_agama'));
        $this->assertTrue(Schema::connection($connection)->hasTable('dapodik_ref_akreditasi'));

        $connections = app('dapodik.eloquent.laravel')->getConnections();
        foreach ($connections as $connection) {
            $tables = $this->getTableNames($connection);
            $this->assertNotEmpty($tables, "Connection {$connection} should have tables after migrate:fresh");
        }
    }

    /** @test */
    public function skip_fresh_preserves_dapodik_tables_on_migrate_fresh()
    {
        $config = config('dapodik-eloquent');
        $config['skip_fresh'] = true;
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
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
            $tables = $this->getTableNames($connection);
            $this->assertNotEmpty($tables, "Connection {$connection} should still have tables when skip_fresh is true");
        }
    }
}
