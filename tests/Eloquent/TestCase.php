<?php

namespace Dapodik\Laravel\Eloquent\Tests;

use Dapodik\Laravel\Eloquent\EloquentServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            EloquentServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Eloquent' => 'Dapodik\Laravel\Eloquent\Facades\Eloquent',
        ];
    }
protected function resolveApplicationBootstrappers($app)
    {
        $app->make('Illuminate\Foundation\Bootstrap\RegisterFacades')->bootstrap($app);
        $app->make('Illuminate\Foundation\Bootstrap\RegisterProviders')->bootstrap($app);

        if (\method_exists($this, 'defineEnvironment')) {
            $this->defineEnvironment($app);
        }

        $this->getEnvironmentSetUp($app);

        $app->make('Illuminate\Foundation\Bootstrap\BootProviders')->bootstrap($app);

        if (method_exists($this, 'parseTestMethodAnnotations')) {
            $this->parseTestMethodAnnotations($app, 'environment-setup');
            $this->parseTestMethodAnnotations($app, 'define-env');
        }

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    }
}
