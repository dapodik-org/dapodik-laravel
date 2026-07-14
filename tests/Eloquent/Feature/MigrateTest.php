<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\Tests\CopiesMigrations;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class MigrateTest extends TestCase
{
    use CopiesMigrations;

    private $migrationsPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->migrationsPath = database_path('migrations/dapodik');
    }

    /** @test */
    public function can_run_migration_up_and_down()
    {
        $agamaFiles = glob($this->migrationsPath.'/*_create_dapodik_agama_table.php');
        require_once $agamaFiles[0];
        $migration = new \CreateDapodikAgamaTable;

        $migration->up();
        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));

        $migration->down();
        $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
    }

    /** @test */
    public function runs_dapodik_migration_via_php_artisan_migrate()
    {
        $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));

        $this->artisan('migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertTrue(Schema::hasTable('dapodik_ref_akreditasi'));
    }

    /** @test */
    public function runs_dapodik_migration_via_php_artisan_migrate_fresh()
    {
        $this->artisan('migrate')->assertExitCode(0);
        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));

        $this->artisan('migrate:fresh')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertTrue(Schema::hasTable('dapodik_ref_akreditasi'));
    }
}
