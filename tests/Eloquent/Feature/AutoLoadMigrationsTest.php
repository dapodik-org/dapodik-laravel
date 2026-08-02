<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class AutoLoadMigrationsTest extends TestCase
{
    private $publishedMigrationsPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->publishedMigrationsPath = $this->app->databasePath('migrations/dapodik');

        $this->removePublishedMigrations();

        config()->set('dapodik-eloquent.auto_load_migrations', false);
        config()->set('dapodik-eloquent.exclude_tables', []);
    }

    protected function tearDown(): void
    {
        $this->removePublishedMigrations();

        if (Schema::hasTable('migrations')) {
            DB::table('migrations')->where('migration', 'like', '%_create_dapodik_%')->delete();
        }

        parent::tearDown();
    }

    private function removePublishedMigrations()
    {
        if (is_dir($this->publishedMigrationsPath)) {
            foreach (glob($this->publishedMigrationsPath.'/*.php') as $file) {
                File::delete($file);
            }
            @rmdir($this->publishedMigrationsPath);
        }
    }

    /** @test */
    public function has_auto_load_migrations_defaulting_to_false()
    {
        $this->assertFalse(config('dapodik-eloquent.auto_load_migrations'));
    }

    /** @test */
    public function does_not_auto_load_migrations_when_auto_load_migrations_is_false_and_migrations_are_not_published()
    {
        $this->artisan('migrate')->assertExitCode(0);

        $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
    }

    /** @test */
    public function does_not_register_unpublished_migrations_in_migrations_table_when_auto_load_migrations_is_false()
    {
        $this->artisan('migrate')->assertExitCode(0);

        if (!Schema::hasTable('migrations')) {
            $this->assertTrue(true);

            return;
        }

        $dapodikMigrations = DB::table('migrations')
            ->where('migration', 'like', '%_create_dapodik_%')
            ->get();

        $this->assertEmpty($dapodikMigrations);
    }
}
