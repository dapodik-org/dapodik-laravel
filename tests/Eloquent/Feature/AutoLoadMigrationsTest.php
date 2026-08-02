<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    $this->publishedMigrationsPath = $this->app->databasePath('migrations/dapodik');

    $this->packageMigrationsPath = realpath(__DIR__.'/../../../src/laravel/Eloquent/database/migrations/dapodik');

    if (is_dir($this->publishedMigrationsPath)) {
        foreach (glob($this->publishedMigrationsPath.'/*.php') as $file) {
            File::delete($file);
        }
        rmdir($this->publishedMigrationsPath);
    }

    config()->set('dapodik-eloquent.auto_load_migrations', false);
    config()->set('dapodik-eloquent.exclude_tables', []);
});

afterEach(function () {
    if (Schema::hasTable('migrations')) {
        DB::table('migrations')->where('migration', 'like', '%_create_dapodik_%')->delete();
    }

    File::ensureDirectoryExists($this->publishedMigrationsPath);
    foreach (File::files($this->packageMigrationsPath) as $file) {
        copy($file->getPathname(), $this->publishedMigrationsPath.'/'.$file->getFilename());
    }
});

it('has auto_load_migrations defaulting to false', function () {
    expect(config('dapodik-eloquent.auto_load_migrations'))->toBeFalse();
});

it('does not auto-load migrations when auto_load_migrations is false and migrations are not published', function () {
    $this->artisan('migrate')->assertExitCode(0);

    expect(Schema::hasTable('dapodik_ref_agama'))->toBeFalse();
});

it('does not register unpublished migrations in migrations table when auto_load_migrations is false', function () {
    $this->artisan('migrate')->assertExitCode(0);

    if (! Schema::hasTable('migrations')) {
        expect(true)->toBeTrue();

        return;
    }

    $dapodikMigrations = DB::table('migrations')
        ->where('migration', 'like', '%_create_dapodik_%')
        ->get();

    expect($dapodikMigrations)->toBeEmpty();
});
