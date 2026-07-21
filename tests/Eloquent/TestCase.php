<?php

namespace Dapodik\Laravel\Eloquent\Tests;

use Dapodik\Laravel\Eloquent\EloquentServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Support\Facades\DB;

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
        // Ensure tests use the testing connection
        config()->set('database.default', 'testing');

        // Register Doctrine DBAL type mappings for database platforms that
        // expose types like `char` or `enum` which DBAL may not map by default.
        if (class_exists(\Doctrine\DBAL\Types\Type::class)) {
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
                    // Map DB `char` to Doctrine `string` to avoid Unknown column type errors
                    $platform->registerDoctrineTypeMapping('char', 'string');
                    // Optional: map enum to string if your schema uses MySQL enums
                    $platform->registerDoctrineTypeMapping('enum', 'string');
                }
            } catch (\Throwable $e) {
                // Swallow errors here so tests don't fail if DBAL/platform is unavailable
            }
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

        if (method_exists($this, 'parseTestMethodAnnotations')) {
            $this->parseTestMethodAnnotations($app, 'environment-setup');
            $this->parseTestMethodAnnotations($app, 'define-env');
        }

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    }
}
