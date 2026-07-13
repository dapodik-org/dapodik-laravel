<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\File;

class PublishMigrationTest extends TestCase
{
    /** @test */
    public function publishes_package_migrations_to_dapodik_subfolder()
    {
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
    }
}
