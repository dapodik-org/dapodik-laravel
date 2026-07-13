<?php

namespace Dapodik\Laravel\API\Tests;

use Dapodik\Laravel\API\APIServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            APIServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    protected function resolveApplicationBootstrappers($app)
    {
        $app->make('Illuminate\Foundation\Bootstrap\HandleExceptions')->bootstrap($app);

        error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

        $app->make('Illuminate\Foundation\Bootstrap\RegisterFacades')->bootstrap($app);
        $app->make('Illuminate\Foundation\Bootstrap\SetRequestForConsole')->bootstrap($app);
        $app->make('Illuminate\Foundation\Bootstrap\RegisterProviders')->bootstrap($app);

        if (\method_exists($this, 'parseTestMethodAnnotations')) {
            $this->parseTestMethodAnnotations($app, 'environment-setup');
            $this->parseTestMethodAnnotations($app, 'define-env');
        }

        if (\method_exists($this, 'defineEnvironment')) {
            $this->defineEnvironment($app);
        }

        $this->getEnvironmentSetUp($app);

        $app->make('Illuminate\Foundation\Bootstrap\BootProviders')->bootstrap($app);

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    }
}
