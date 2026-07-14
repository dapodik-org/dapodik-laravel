<?php

use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Config::set('database.default', 'testing');
    Config::set('database.connections.testing', [
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => '',
    ]);

    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');
});

it('returns the model class', function () {
    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };
    $this->assertEquals(Agama::class, $migration->getModel());
});

it('returns the table name from the model', function () {
    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };
    $this->assertEquals('dapodik_ref_agama', $migration->getTable());
});

it('returns the default connection when split connection is false and no connection config', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };
    $this->assertEquals('testing', $migration->getConnection());
});

it('returns the configured connection when split connection is false and connection config is set', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['connection'] = 'custom_conn';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };
    $this->assertEquals('custom_conn', $migration->getConnection());
});

it('returns the split connection when split connection is true', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['split_connection'] = true;
    $config['connection'] = 'testing';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };
    $this->assertEquals('testing_ref', $migration->getConnection());
});

it('does not call create schema if not exist for non pgsql drivers', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['split_connection'] = true;
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };
    $migration->createSchemaIfNotExist();
    $this->assertTrue(true);
});

it('creates table via create table', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };

    $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
    $migration->createTable(function ($table) {
        $table->string('agama_id', 10)->primary();
        $table->string('nama', 100);
    });
    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
});

it('drops table via drop table', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };

    $migration->createTable(function ($table) {
        $table->string('agama_id', 10)->primary();
        $table->string('nama', 100);
    });
    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));

    $migration->dropTable();
    $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
});

it('drops columns via drop columns', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };

    $migration->createTable(function ($table) {
        $table->string('agama_id', 10)->primary();
        $table->string('nama', 100);
        $table->string('keterangan', 200)->nullable();
    });
    $this->assertTrue(Schema::hasColumn('dapodik_ref_agama', 'keterangan'));

    $migration->dropColumns('keterangan');
    $this->assertFalse(Schema::hasColumn('dapodik_ref_agama', 'keterangan'));
});

it('is idempotent on create table', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $migration = new class extends Migration
    {
        protected $model = Agama::class;
    };

    $migration->createTable(function ($table) {
        $table->string('agama_id', 10)->primary();
        $table->string('nama', 100);
    });
    $migration->createTable(function ($table) {
        $table->string('agama_id', 10)->primary();
        $table->string('nama', 100);
    });
    $this->assertTrue(true);
});
