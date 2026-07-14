<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\Models\Ref\Akreditasi;
use Dapodik\Laravel\Eloquent\Tests\CopiesMigrations;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ExcludeTablesMigrationTest extends TestCase
{
    use CopiesMigrations;

    private $migrationsPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->migrationsPath = database_path('migrations/dapodik');
    }

    private function removeExcludedMigrationFiles(array $excludeTables)
    {
        if (empty($excludeTables)) {
            return;
        }

        $migrationModelMap = [
            'create_dapodik_akreditasi_table' => ['table' => 'akreditasi', 'table_full' => 'dapodik_ref_akreditasi', 'model' => Akreditasi::class],
            'create_dapodik_sekolah_table' => ['table' => 'sekolah', 'table_full' => 'dapodik_sekolah', 'model' => ''],
            'create_dapodik_agama_table' => ['table' => 'agama', 'table_full' => 'dapodik_ref_agama', 'model' => ''],
            'create_dapodik_sync_log_table' => ['table' => 'sync_log', 'table_full' => 'dapodik_sync_log', 'model' => ''],
            'create_dapodik_sync_primer_table' => ['table' => 'sync_primer', 'table_full' => 'dapodik_sync_primer', 'model' => ''],
            'create_dapodik_sync_session_table' => ['table' => 'sync_session', 'table_full' => 'dapodik_sync_session', 'model' => ''],
            'create_dapodik_table_sync_log_table' => ['table' => 'table_sync_log', 'table_full' => 'dapodik_table_sync_log', 'model' => ''],
        ];

        $files = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');

        foreach ($files as $filePath) {
            $basename = basename($filePath);
            $basenameNoTimestamp = preg_replace('/^\d{4}_\d{2}_\d{2}_\d{6}_/', '', $basename);
            $basenameNoExt = str_replace('.php', '', $basenameNoTimestamp);

            $info = isset($migrationModelMap[$basenameNoExt]) ? $migrationModelMap[$basenameNoExt] : null;

            foreach ($excludeTables as $excluded) {
                $isRegex = Str::startsWith($excluded, '/') && Str::endsWith($excluded, '/');

                if ($isRegex) {
                    if (preg_match($excluded, $basenameNoExt)) {
                        @unlink($filePath);

                        continue 2;
                    }
                    if ($info !== null && (preg_match($excluded, $info['table']) || preg_match($excluded, $info['table_full']) || preg_match($excluded, $info['model']))) {
                        @unlink($filePath);

                        continue 2;
                    }

                    continue;
                }

                if ($basenameNoExt === $excluded) {
                    @unlink($filePath);

                    continue 2;
                }

                if ($info !== null) {
                    if ($info['table'] === $excluded || $info['table_full'] === $excluded || $info['model'] === $excluded) {
                        @unlink($filePath);

                        continue 2;
                    }
                }
            }
        }
    }

    /** @test */
    public function skips_creating_excluded_tables_configured_by_full_table_name()
    {
        $this->removeExcludedMigrationFiles(['dapodik_ref_akreditasi']);

        $this->artisan('migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertFalse(Schema::hasTable('dapodik_ref_akreditasi'));
    }

    /** @test */
    public function skips_creating_excluded_tables_configured_by_model_key_name()
    {
        $this->removeExcludedMigrationFiles(['akreditasi']);

        $this->artisan('migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertFalse(Schema::hasTable('dapodik_ref_akreditasi'));
    }

    /** @test */
    public function skips_creating_excluded_tables_configured_by_fully_qualified_class_name()
    {
        $this->removeExcludedMigrationFiles([Akreditasi::class]);

        $this->artisan('migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertFalse(Schema::hasTable('dapodik_ref_akreditasi'));
    }

    /** @test */
    public function skips_creating_multiple_excluded_tables()
    {
        $this->removeExcludedMigrationFiles(['dapodik_ref_akreditasi', 'dapodik_sekolah']);

        $this->artisan('migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertFalse(Schema::hasTable('dapodik_ref_akreditasi'));
        $this->assertFalse(Schema::hasTable('dapodik_sekolah'));
    }

    /** @test */
    public function runs_all_migrations_when_exclude_tables_is_empty()
    {
        $this->removeExcludedMigrationFiles([]);

        $this->artisan('migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertTrue(Schema::hasTable('dapodik_ref_akreditasi'));
        $this->assertTrue(Schema::hasTable('dapodik_sekolah'));
    }

    /** @test */
    public function skips_excluded_tables_using_regex_pattern_on_migration_filename()
    {
        $this->removeExcludedMigrationFiles(['/^create_dapodik_sync_.*/']);

        $this->artisan('migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertFalse(Schema::hasTable('dapodik_sync_log'));
        $this->assertFalse(Schema::hasTable('dapodik_sync_primer'));
        $this->assertFalse(Schema::hasTable('dapodik_sync_session'));
    }

    /** @test */
    public function skips_excluded_tables_using_regex_pattern_on_table_key()
    {
        $this->removeExcludedMigrationFiles(['/^sync_.*/']);

        $this->artisan('migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertFalse(Schema::hasTable('dapodik_sync_log'));
        $this->assertFalse(Schema::hasTable('dapodik_sync_primer'));
        $this->assertFalse(Schema::hasTable('dapodik_sync_session'));
    }

    /** @test */
    public function does_not_register_excluded_migration_in_migrations_table()
    {
        $this->removeExcludedMigrationFiles(['akreditasi']);

        $this->artisan('migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertFalse(Schema::hasTable('dapodik_ref_akreditasi'));

        $migrations = DB::table('migrations')->pluck('migration');
        $akreditasiExists = $migrations->contains(function ($m) {
            return strpos($m, 'create_dapodik_akreditasi_table') !== false;
        });

        $this->assertFalse($akreditasiExists);
    }
}
