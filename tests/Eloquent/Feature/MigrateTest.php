<?php

use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    $migrationsPath = $this->app->databasePath('migrations/dapodik');
    if (! is_dir($migrationsPath)) {
        mkdir($migrationsPath, 0755, true);
    }
    $sourcePath = realpath(__DIR__.'/../../../src/laravel/Eloquent/database/migrations/dapodik');
    foreach (glob($sourcePath.'/*.php') as $file) {
        $dest = $migrationsPath.'/'.basename($file);
        copy($file, $dest);
    }
    $config = $this->app['config']->get('dapodik-eloquent', []);
    $config['exclude_tables'] = [];
    $this->app['config']->set('dapodik-eloquent', $config);

    $this->migrationsPath = database_path('migrations/dapodik');
});

it('can run migration up and down', function () {
    $agamaFiles = glob($this->migrationsPath.'/*_create_dapodik_agama_table.php');
    $migration = require $agamaFiles[0];

    $migration->up();
    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));

    $migration->down();
    $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
});

it('runs dapodik migration via php artisan migrate', function () {
    $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));

    $this->artisan('migrate')->assertExitCode(0);

    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
    $this->assertTrue(Schema::hasTable('dapodik_ref_akreditasi'));
});

it('runs dapodik migration via php artisan migrate fresh', function () {
    $this->artisan('migrate')->assertExitCode(0);

    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));

    $this->artisan('migrate:fresh')->assertExitCode(0);

    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
});
