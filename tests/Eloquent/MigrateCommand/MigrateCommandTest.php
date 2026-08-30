<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentMigrateCommand;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class MigrateCommandTest extends TestCase
{
    private $publishedMigrationsPath;

    private $packageMigrationsPath;

    protected function setUp(): void
    {
        parent::setUp();

        try {
            DB::table('migrations')->where('migration', 'like', '%_create_dapodik_%')->delete();
        } catch (\Throwable $e) {
        }

        $this->publishedMigrationsPath = $this->app->databasePath('migrations/dapodik');

        $this->packageMigrationsPath = realpath(__DIR__.'/../../../src/laravel/Eloquent/database/migrations/dapodik');

        if (!is_dir($this->publishedMigrationsPath)) {
            mkdir($this->publishedMigrationsPath, 0755, true);
        }

        foreach (glob($this->publishedMigrationsPath.'/*.php') as $file) {
            File::delete($file);
        }

        config()->set('dapodik-eloquent.auto_load_migrations', false);
        config()->set('dapodik-eloquent.exclude_tables', []);
    }

    protected function tearDown(): void
    {
        if (Schema::hasTable('migrations')) {
            DB::table('migrations')->where('migration', 'like', '%_create_dapodik_%')->delete();
        }

        foreach (glob($this->publishedMigrationsPath.'/*.php') as $file) {
            File::delete($file);
        }

        parent::tearDown();
    }

    public function testCommandClassExists()
    {
        $this->assertTrue(class_exists(DapodikEloquentMigrateCommand::class));
    }

    public function testRunsDapodikMigrationsFromPackagePath()
    {
        $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));

        $this->artisan('dapodik:migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
        $this->assertTrue(Schema::hasTable('dapodik_ref_akreditasi'));
    }

    public function testDoesNotTouchNonDapodikTables()
    {
        Schema::create('custom_user_table', function($table) {
            $table->id();
            $table->string('name');
        });

        $this->artisan('dapodik:migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('custom_user_table'));
        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
    }

    public function testFreshDropsAndRecreatesTables()
    {
        $this->artisan('dapodik:migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));

        Schema::table('dapodik_ref_agama', function($table) {
            $table->dropColumn('nama');
        });

        $this->assertFalse(Schema::hasColumn('dapodik_ref_agama', 'nama'));

        $this->artisan('dapodik:migrate', ['--fresh' => true])->assertExitCode(0);

        $this->assertTrue(Schema::hasColumn('dapodik_ref_agama', 'nama'));
    }

    public function testFailsWhenMigrationsPathDoesNotExist()
    {
        $this->artisan('dapodik:migrate', ['--path' => '/non/existent/path'])->assertExitCode(1);
    }

    public function testPretendModeDoesNotExecuteMigrations()
    {
        $this->artisan('dapodik:migrate', ['--pretend' => true])->assertExitCode(0);

        $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
    }

    public function testArtisanMigrateDoesNotRunDapodikWhenAutoLoadDisabled()
    {
        $this->artisan('migrate')->assertExitCode(0);

        $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
    }

    public function testDapodikMigrateAfterArtisanMigrate()
    {
        $this->artisan('migrate')->assertExitCode(0);

        $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));

        $this->artisan('dapodik:migrate')->assertExitCode(0);

        $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
    }
}
