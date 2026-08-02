<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentPublishMigrationCommand;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\File;

class PublishMigrationTest extends TestCase
{
    private $migrationsPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->migrationsPath = database_path('migrations');
    }

    protected function tearDown(): void
    {
        $sourcePath = realpath(__DIR__.'/../../../src/laravel/Eloquent/database/migrations/dapodik');

        foreach (glob($sourcePath.'/*.php') as $source) {
            $published = $this->migrationsPath.'/'.basename($source);
            if (is_file($published)) {
                File::delete($published);
            }
        }

        parent::tearDown();
    }

    private function assertIsStandardLaravelMigration($content)
    {
        $this->assertStringContainsString(
            'use Illuminate\\Database\\Migrations\\Migration;',
            $content
        );
        $this->assertStringContainsString(
            'use Illuminate\\Support\\Facades\\Schema;',
            $content
        );
        $this->assertStringNotContainsString(
            'use Dapodik\\Laravel\\Eloquent\\Migration;',
            $content
        );
        $this->assertStringNotContainsString(
            'protected $model =',
            $content
        );
        $this->assertStringNotContainsString(
            '$this->createSchemaIfNotExist()',
            $content
        );
        $this->assertStringContainsString(
            'Schema::create(',
            $content
        );
        $this->assertStringContainsString(
            'Schema::dropIfExists(',
            $content
        );
    }

    /** @test */
    public function publishes_package_migrations_and_transforms_them()
    {
        $existing = glob($this->migrationsPath.'/*create_dapodik_agama_table.php');
        foreach ($existing as $file) {
            File::delete($file);
        }

        $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'agama'])
            ->assertExitCode(0);

        $published = glob($this->migrationsPath.'/*create_dapodik_agama_table.php');

        $this->assertNotEmpty($published);

        $content = File::get($published[0]);
        $this->assertIsStandardLaravelMigration($content);
    }

    /** @test */
    public function verifies_the_migration_publish_command_is_available()
    {
        $this->assertTrue(class_exists(DapodikEloquentPublishMigrationCommand::class));
    }

    /** @test */
    public function can_publish_all_migrations_using_artisan()
    {
        $this->artisan('dapodik:eloquent-publish-migration')
            ->assertExitCode(0);

        $agamaFile = glob($this->migrationsPath.'/*create_dapodik_agama_table.php');
        $this->assertNotEmpty($agamaFile);

        $content = File::get($agamaFile[0]);
        $this->assertIsStandardLaravelMigration($content);
    }

    /** @test */
    public function can_publish_a_single_migration_using_artisan()
    {
        $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'agama'])
            ->assertExitCode(0);

        $agamaFile = glob($this->migrationsPath.'/*create_dapodik_agama_table.php');
        $this->assertNotEmpty($agamaFile);

        $akreditasiFile = glob($this->migrationsPath.'/*create_dapodik_akreditasi_table.php');
        $this->assertEmpty($akreditasiFile);

        $content = File::get($agamaFile[0]);
        $this->assertIsStandardLaravelMigration($content);
    }

    /** @test */
    public function fails_when_migration_is_not_found()
    {
        $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'non_existent_migration'])
            ->assertExitCode(1);
    }

    /** @test */
    public function can_republish_migration_with_force_flag()
    {
        $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'agama'])
            ->assertExitCode(0);

        $agamaFile = glob($this->migrationsPath.'/*create_dapodik_agama_table.php');
        $this->assertNotEmpty($agamaFile);

        $originalContent = File::get($agamaFile[0]);

        $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'agama', '--force' => true])
            ->assertExitCode(0);

        $newContent = File::get($agamaFile[0]);

        $this->assertEquals($originalContent, $newContent);
        $this->assertIsStandardLaravelMigration($newContent);
    }
}
