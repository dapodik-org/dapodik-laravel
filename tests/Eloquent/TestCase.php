<?php

namespace Dapodik\Laravel\Eloquent\Tests;

use Dapodik\Laravel\Eloquent\EloquentServiceProvider;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\DB;
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

    protected function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    /**
     * Register Doctrine DBAL type mappings after providers are booted so the
     * database connection/platform is available.
     */
    protected function registerDoctrineTypeMappings(): void
    {
        if (! class_exists(Type::class)) {
            return;
        }

        try {
            $connection = DB::connection();

            if (method_exists($connection, 'getDoctrineSchemaManager')) {
                $platform = $connection->getDoctrineSchemaManager()->getDatabasePlatform();
            } elseif (method_exists($connection, 'getDoctrineConnection')) {
                $platform = $connection->getDoctrineConnection()->getDatabasePlatform();
            } else {
                $platform = null;
            }

            if ($platform) {
                $platform->registerDoctrineTypeMapping('char', 'string');
                $platform->registerDoctrineTypeMapping('enum', 'string');
            }
        } catch (\Throwable $e) {
            // swallow errors to avoid breaking test bootstrap
        }
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

        // Now that providers are booted and DB is available, register Doctrine mappings
        $this->registerDoctrineTypeMappings();

        if (method_exists($this, 'parseTestMethodAnnotations')) {
            $this->parseTestMethodAnnotations($app, 'environment-setup');
            $this->parseTestMethodAnnotations($app, 'define-env');
        }

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    }
}
