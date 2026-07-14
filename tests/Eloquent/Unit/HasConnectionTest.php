<?php

use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Illuminate\Support\Facades\Config;

beforeEach(function () {
    Config::set('database.default', 'testing');

    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    config()->set('dapodik-eloquent', $config);
});

it('returns config default connection when use split connection is false', function () {
    Config::set('database.default', 'testing');
    $model = new Agama;
    $this->assertEquals('testing', $model->getConnectionName());
});

it('returns configured connection name when connection config is set and split is false', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['connection'] = 'dapodik';
    config()->set('dapodik-eloquent', $config);
    $model = new Agama;
    $this->assertEquals('dapodik', $model->getConnectionName());
});

it('returns split connection name when split connection is true and connection is set', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['split_connection'] = true;
    $config['connection'] = 'testing';
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $model = new Agama;
    $this->assertEquals('testing_ref', $model->getConnectionName());
});

it('returns split connection name when split connection is true and connection is null', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['split_connection'] = true;
    config()->set('dapodik-eloquent', $config);

    app()->forgetInstance('dapodik.eloquent.laravel');
    app()->singleton('dapodik.eloquent.laravel', function ($app) {
        return new EloquentManager($app);
    });
    app('dapodik.eloquent.laravel');

    $model = new Agama;
    $this->assertEquals('testing_ref', $model->getConnectionName());
});

it('returns table name with folder segment for namespaced models', function () {
    $model = new Agama;
    $this->assertEquals('dapodik_ref_agama', $model->getTable());
});

it('returns table name with custom prefix', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['prefix'] = 'custom_';
    config()->set('dapodik-eloquent', $config);

    $model = new Agama;
    $this->assertEquals('custom_ref_agama', $model->getTable());
});

it('returns table name with suffix', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['suffix'] = '_suffix';
    config()->set('dapodik-eloquent', $config);

    $model = new Agama;
    $this->assertEquals('dapodik_ref_agama_suffix', $model->getTable());
});

it('returns table name with prefix and suffix', function () {
    $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
    $config['prefix'] = 'pre_';
    $config['suffix'] = '_suf';
    config()->set('dapodik-eloquent', $config);

    $model = new Agama;
    $this->assertEquals('pre_ref_agama_suf', $model->getTable());
});

it('get schema returns null on fresh model', function () {
    $model = new Agama;
    $this->assertNull($model->getSchema());
});

it('set schema stores and get schema retrieves', function () {
    $model = new Agama;
    $model->setSchema('custom_schema');
    $this->assertEquals('custom_schema', $model->getSchema());
});

it('get guarded returns empty array', function () {
    $model = new Agama;
    $this->assertEquals([], $model->getGuarded());
});
