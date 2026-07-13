<?php

namespace Dapodik\Laravel\Eloquent\Tests\Unit;

use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class MigrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Config::set('database.default', 'testing');
        Config::set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');
    }

    /** @test */
    public function returns_the_model_class()
    {
        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };
        $this->assertEquals(Agama::class, $migration->getModel());
    }

    /** @test */
    public function returns_the_table_name_from_the_model()
    {
        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };
        $this->assertEquals('dapodik_ref_agama', $migration->getTable());
    }

    /** @test */
    public function returns_the_default_connection_when_split_connection_is_false_and_no_connection_config()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };
        $this->assertEquals('testing', $migration->getConnection());
    }

    /** @test */
    public function returns_the_configured_connection_when_split_connection_is_false_and_connection_config_is_set()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['connection'] = 'custom_conn';
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };
        $this->assertEquals('custom_conn', $migration->getConnection());
    }

    /** @test */
    public function returns_the_split_connection_when_split_connection_is_true()
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

        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };
        $this->assertEquals('testing_ref', $migration->getConnection());
    }

    /** @test */
    public function does_not_call_createSchemaIfNotExist_for_non_pgsql_drivers()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['split_connection'] = true;
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };
        $migration->createSchemaIfNotExist();
        $this->assertTrue(true);
    }

    /** @test */
    public function creates_table_via_createTable()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };

        $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
        $migration->createTable(function($table) {
            $table->string('agama_id', 10)->primary();
            $table->string('nama', 100);
        });
        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
    }

    /** @test */
    public function drops_table_via_dropTable()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };

        $migration->createTable(function($table) {
            $table->string('agama_id', 10)->primary();
            $table->string('nama', 100);
        });
        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));

        $migration->dropTable();
        $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
    }

    /** @test */
    public function drops_columns_via_dropColumns()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };

        $migration->createTable(function($table) {
            $table->string('agama_id', 10)->primary();
            $table->string('nama', 100);
            $table->string('keterangan', 200)->nullable();
        });
        $this->assertTrue(Schema::hasColumn('dapodik_ref_agama', 'keterangan'));

        $migration->dropColumns('keterangan');
        $this->assertFalse(Schema::hasColumn('dapodik_ref_agama', 'keterangan'));
    }

    /** @test */
    public function is_idempotent_on_createTable()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $migration = new class() extends Migration {
            protected $model = Agama::class;
        };

        $migration->createTable(function($table) {
            $table->string('agama_id', 10)->primary();
            $table->string('nama', 100);
        });
        $migration->createTable(function($table) {
            $table->string('agama_id', 10)->primary();
            $table->string('nama', 100);
        });
        $this->assertTrue(true);
    }
}
