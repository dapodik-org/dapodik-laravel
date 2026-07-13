<?php

namespace Dapodik\Laravel\Eloquent\Tests\Unit;

use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\Config;

class HasConnectionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Config::set('database.default', 'testing');

        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        config()->set('dapodik-eloquent', $config);
    }

    /** @test */
    public function returns_config_default_connection_when_useSplitConnection_is_false()
    {
        Config::set('database.default', 'testing');
        $model = new Agama();
        $this->assertEquals('testing', $model->getConnectionName());
    }

    /** @test */
    public function returns_configured_connection_name_when_connection_config_is_set_and_split_is_false()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['connection'] = 'dapodik';
        config()->set('dapodik-eloquent', $config);
        $model = new Agama();
        $this->assertEquals('dapodik', $model->getConnectionName());
    }

    /** @test */
    public function returns_split_connection_name_when_split_connection_is_true_and_connection_is_set()
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

        $model = new Agama();
        $this->assertEquals('testing_ref', $model->getConnectionName());
    }

    /** @test */
    public function returns_split_connection_name_when_split_connection_is_true_and_connection_is_null()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['split_connection'] = true;
        $config['connection'] = null;
        config()->set('dapodik-eloquent', $config);

        app()->forgetInstance('dapodik.eloquent.laravel');
        app()->singleton('dapodik.eloquent.laravel', function($app) {
            return new EloquentManager($app);
        });
        app('dapodik.eloquent.laravel');

        $model = new Agama();
        $this->assertEquals('testing_ref', $model->getConnectionName());
    }

    /** @test */
    public function returns_table_name_with_folder_segment_for_namespaced_models()
    {
        $model = new Agama();
        $this->assertEquals('dapodik_ref_agama', $model->getTable());
    }

    /** @test */
    public function returns_table_name_with_custom_prefix()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['prefix'] = 'custom';
        config()->set('dapodik-eloquent', $config);
        $model = new Agama();
        $this->assertEquals('custom_ref_agama', $model->getTable());
    }

    /** @test */
    public function returns_table_name_with_suffix()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['suffix'] = '2024';
        config()->set('dapodik-eloquent', $config);
        $model = new Agama();
        $this->assertEquals('dapodik_ref_agama_2024', $model->getTable());
    }

    /** @test */
    public function returns_table_name_with_prefix_and_suffix()
    {
        $config = require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php';
        $config['prefix'] = 'custom';
        $config['suffix'] = '2024';
        config()->set('dapodik-eloquent', $config);
        $model = new Agama();
        $this->assertEquals('custom_ref_agama_2024', $model->getTable());
    }

    /** @test */
    public function getSchema_returns_null_on_fresh_model()
    {
        $model = new Agama();
        $this->assertNull($model->getSchema());
    }

    /** @test */
    public function setSchema_stores_and_getSchema_retrieves()
    {
        $model = new Agama();
        $model->setSchema('custom_schema');
        $this->assertEquals('custom_schema', $model->getSchema());
    }

    /** @test */
    public function getGuarded_returns_empty_array()
    {
        $model = new Agama();
        $this->assertEquals([], $model->getGuarded());
    }
}
