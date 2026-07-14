<?php

namespace Dapodik\Laravel\Eloquent\Tests;

trait CopiesMigrations
{
    protected function getEnvironmentSetUp($app)
    {
        $migrationsPath = $app->databasePath('migrations/dapodik');

        if (! is_dir($migrationsPath)) {
            mkdir($migrationsPath, 0755, true);
        }

        $sourcePath = realpath(__DIR__.'/../../src/laravel/Eloquent/database/migrations/dapodik');

        if ($sourcePath === false) {
            throw new \RuntimeException('Source migrations path not found: '.__DIR__.'/../../src/laravel/Eloquent/database/migrations/dapodik');
        }

        foreach (glob($sourcePath.'/*.php') as $file) {
            $dest = $migrationsPath.'/'.basename($file);
            copy($file, $dest);
        }

        $config = $app['config']->get('dapodik-eloquent', []);
        $config['exclude_tables'] = [];
        $app['config']->set('dapodik-eloquent', $config);
    }
}
