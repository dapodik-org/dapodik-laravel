<?php

namespace Dapodik\Laravel\Eloquent\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class DapodikEloquentPublishCommand extends Command
{
    const SUCCESS = 0;

    const FAILURE = 1;

    protected $signature = 'dapodik:eloquent-publish {model? : The model key to publish (e.g. agama)} {--force : Overwrite existing files without confirmation}';

    protected $description = 'Publish Eloquent model stubs from the package to the application';

    public function handle(Filesystem $files)
    {
        $model = $this->argument('model');
        $force = $this->option('force');
        $sourceRoot = __DIR__.'/../Models';
        $destinationRoot = app_path('Models/Dapodik');

        if (! $files->isDirectory($sourceRoot)) {
            $this->error('Source models directory not found.');

            return self::FAILURE;
        }

        $filesToPublish = $this->getPublishableFiles($files, $sourceRoot);

        if ($model) {
            $models = $filesToPublish
                ->filter(function ($file) use ($model) {
                    return $file->getBasename('.php') === Str::studly($model);
                });

            if ($models->isEmpty()) {
                $this->error("Model '{$model}' not found in package.");

                return self::FAILURE;
            }

            foreach ($models as $modelFile) {
                $this->publishModelStub($files, $modelFile->getPathname(), $sourceRoot, $destinationRoot, $force);
            }

            $this->info('Published model: '.Str::studly($model));

            return self::SUCCESS;
        }

        foreach ($filesToPublish as $modelFile) {
            $this->publishModelStub($files, $modelFile->getPathname(), $sourceRoot, $destinationRoot, $force);
        }

        $this->info('Published all package model stubs to '.$destinationRoot);

        return self::SUCCESS;
    }

    protected function publishModelStub(Filesystem $files, $sourceFile, $sourceRoot, $destinationRoot, $force = false)
    {
        $relativePath = ltrim(str_replace($sourceRoot, '', $sourceFile), DIRECTORY_SEPARATOR);
        $destinationFile = $destinationRoot.'/'.$relativePath;
        $destinationDirectory = dirname($destinationFile);

        $files->ensureDirectoryExists($destinationDirectory);

        if ($files->exists($destinationFile) && ! $force) {
            $this->line("Skipped (already exists): {$relativePath}");

            return;
        }

        $packageNamespace = $this->getPackageNamespace($sourceFile, $sourceRoot);
        $appNamespace = $this->getAppNamespace($sourceFile, $sourceRoot);

        $className = pathinfo($sourceFile, PATHINFO_FILENAME);
        $baseClassName = 'Base'.$className;

        $stub = $this->generateStub($appNamespace, $packageNamespace, $className, $baseClassName);

        $files->put($destinationFile, $stub);

        $this->line("Created: {$relativePath}");
    }

    protected function getPublishableFiles(Filesystem $files, $sourceRoot)
    {
        return collect($files->allFiles($sourceRoot))
            ->reject(function ($file) {
                return $file->getBasename('.php') === 'Model';
            });
    }

    protected function getPackageNamespace($sourceFile, $sourceRoot)
    {
        $relativePath = ltrim(str_replace($sourceRoot, '', $sourceFile), DIRECTORY_SEPARATOR);
        $relativeDir = pathinfo($relativePath, PATHINFO_DIRNAME);
        $namespaceDir = str_replace(DIRECTORY_SEPARATOR, '\\', $relativeDir);

        return 'Dapodik\\Laravel\\Eloquent\\Models'.($namespaceDir ? '\\'.$namespaceDir : '');
    }

    protected function getAppNamespace($sourceFile, $sourceRoot)
    {
        $relativePath = ltrim(str_replace($sourceRoot, '', $sourceFile), DIRECTORY_SEPARATOR);
        $relativeDir = pathinfo($relativePath, PATHINFO_DIRNAME);
        $namespaceDir = str_replace(DIRECTORY_SEPARATOR, '\\', $relativeDir);

        return 'App\\Models\\Dapodik'.($namespaceDir ? '\\'.$namespaceDir : '');
    }

    protected function generateStub($appNamespace, $packageNamespace, $className, $baseClassName)
    {
        return <<<PHP
<?php

namespace {$appNamespace};

use {$packageNamespace}\\{$className} as {$baseClassName};

class {$className} extends {$baseClassName}
{
    //
}

PHP;
    }
}
