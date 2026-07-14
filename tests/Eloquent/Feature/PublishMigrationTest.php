<?php

use Illuminate\Support\Facades\File;

it('publishes package migrations to dapodik subfolder', function () {
    $migrationsPath = database_path('migrations/dapodik');

    File::ensureDirectoryExists($migrationsPath);

    $existing = glob($migrationsPath.'/*create_dapodik_agama_table.php');
    foreach ($existing as $file) {
        File::delete($file);
    }

    $this->artisan('vendor:publish', ['--tag' => 'dapodik-eloquent-migrations'])
        ->assertExitCode(0);

    $published = glob($migrationsPath.'/*create_dapodik_agama_table.php');

    $this->assertNotEmpty($published);

    foreach ($published as $file) {
        File::delete($file);
    }
});
