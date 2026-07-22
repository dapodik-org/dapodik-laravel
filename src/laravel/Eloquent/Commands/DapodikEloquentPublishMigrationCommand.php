<?php

namespace Dapodik\Laravel\Eloquent\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class DapodikEloquentPublishMigrationCommand extends Command
{
    const SUCCESS = 0;

    const FAILURE = 1;

    protected $signature = 'dapodik:eloquent-publish-migration {migration? : The migration key to publish (e.g. agama)} {--force : Overwrite existing files without confirmation}';

    protected $description = 'Publish Eloquent migration stubs from the package to the application';

    public function handle(Filesystem $files)
    {
        $migration = $this->argument('migration');
        $force = $this->option('force');
        $sourceRoot = __DIR__.'/../database/migrations/dapodik';
        $destinationRoot = $this->laravel->databasePath('migrations');

        if (! $files->isDirectory($sourceRoot)) {
            $this->error('Source migrations directory not found.');

            return self::FAILURE;
        }

        $filesToPublish = collect($files->files($sourceRoot));

        if ($migration) {
            $snakeKey = Str::snake($migration);
            $matched = $filesToPublish->filter(function ($file) use ($snakeKey) {
                return Str::contains($file->getBasename('.php'), $snakeKey);
            });

            if ($matched->isEmpty()) {
                $this->error("Migration '{$migration}' not found in package.");

                return self::FAILURE;
            }

            foreach ($matched as $file) {
                $this->publishStub($files, $file->getPathname(), $sourceRoot, $destinationRoot, $force);
            }

            $this->info('Published migration: '.$migration);

            return self::SUCCESS;
        }

        foreach ($filesToPublish as $file) {
            $this->publishStub($files, $file->getPathname(), $sourceRoot, $destinationRoot, $force);
        }

        $this->info('Published all package migration stubs.');

        return self::SUCCESS;
    }

    protected function publishStub(Filesystem $files, $sourceFile, $sourceRoot, $destinationRoot, $force = false)
    {
        $relativePath = ltrim(str_replace($sourceRoot, '', $sourceFile), DIRECTORY_SEPARATOR);
        $destinationFile = $destinationRoot.'/'.$relativePath;
        $destinationDirectory = dirname($destinationFile);

        $files->ensureDirectoryExists($destinationDirectory);

        if ($files->exists($destinationFile) && ! $force) {
            $this->line("Skipped (already exists): {$relativePath}");

            return;
        }

        $stub = $files->get($sourceFile);
        $stub = $this->transformToLaravelMigration($stub);
        $files->put($destinationFile, $stub);

        $this->line("Created: {$relativePath}");
    }

    protected function transformToLaravelMigration($stub)
    {
        preg_match('/^use (Dapodik\\\\Laravel\\\\Eloquent\\\\Models\\\\.+);$/m', $stub, $matches);
        $modelClass = $matches[1] ?? null;

        $tableName = 'unknown';
        if ($modelClass && class_exists($modelClass)) {
            $tableName = app($modelClass)->getTable();
        }

        $stub = str_replace(
            'use Dapodik\\Laravel\\Eloquent\\Migration;',
            "use Illuminate\\Database\\Migrations\\Migration;\nuse Illuminate\\Support\\Facades\\Schema;",
            $stub
        );

        $stub = preg_replace(
            '/^use Dapodik\\\\Laravel\\\\Eloquent\\\\Models\\\\.+;$/m',
            '',
            $stub
        );

        $stub = preg_replace('/^\s+protected \$model = .+;\n?/m', '', $stub);

        $stub = str_replace("\$this->createSchemaIfNotExist();\n", '', $stub);

        $stub = str_replace(
            '$this->createTable(',
            "Schema::create('{$tableName}', ",
            $stub
        );

        $stub = str_replace(
            '$this->dropTable();',
            "Schema::dropIfExists('{$tableName}');",
            $stub
        );

        return $stub;
    }
}
