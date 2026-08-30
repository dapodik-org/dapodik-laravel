<?php

namespace Dapodik\Laravel\Eloquent\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class DapodikEloquentMigrateCommand extends Command
{
    const SUCCESS = 0;

    const FAILURE = 1;

    protected $signature = 'dapodik:migrate
        {--fresh : Drop all dapodik tables before migrating}
        {--seed : Run the database seeders after migrating}
        {--force : Force the operation to run in production}
        {--pretend : Dump the SQL queries that would be run}
        {--database= : The database connection to use}
        {--path= : The path to the migrations directory to use}';

    protected $description = 'Run Dapodik migrations only (without running other application migrations)';

    protected function resolveDapodikMigrationsPath(): string
    {
        $packagePath = realpath(__DIR__.'/../database/migrations/dapodik');

        if ($packagePath === false) {
            $packagePath = __DIR__.'/../database/migrations/dapodik';
        }

        return $packagePath;
    }

    public function handle()
    {
        $connection = $this->option('database')
            ?: Config::get('dapodik-eloquent.connection')
            ?: Config::get('database.default');

        $dapodikPath = $this->option('path')
            ?: $this->resolveDapodikMigrationsPath();

        if (! is_dir($dapodikPath)) {
            $this->error("Dapodik migrations path not found: {$dapodikPath}");

            return self::FAILURE;
        }

        if ($this->option('fresh')) {
            $this->warn('Dropping all dapodik tables on connection: '.$connection);
            $this->callSilently('db:wipe', [
                '--database' => $connection,
                '--force' => true,
            ]);
        }

        $params = [
            '--path' => [$dapodikPath],
            '--realpath' => true,
            '--database' => $connection,
            '--force' => $this->option('force'),
        ];

        if ($this->option('pretend')) {
            $params['--pretend'] = true;
        }

        $exit = Artisan::call('migrate', $params);

        if ($exit !== self::SUCCESS) {
            return $exit;
        }

        if ($this->option('seed')) {
            Artisan::call('db:seed', ['--force' => $this->option('force')]);
        }

        return self::SUCCESS;
    }
}
