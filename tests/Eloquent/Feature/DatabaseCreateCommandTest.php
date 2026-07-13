<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentDatabaseCreateCommand;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class DatabaseCreateCommandTest extends TestCase
{
    /** @test */
    public function verifies_the_database_create_command_is_available()
    {
        $this->assertTrue(class_exists(DapodikEloquentDatabaseCreateCommand::class));
    }

    /** @test */
    public function creates_a_sqlite_database_file_if_it_does_not_exist()
    {
        $dbPath = sys_get_temp_dir().'/dapodik-test-'.uniqid().'.sqlite';

        Config::set('dapodik-eloquent.connection', 'sqlite_test');
        Config::set('database.connections.sqlite_test', [
            'driver' => 'sqlite',
            'database' => $dbPath,
        ]);

        $this->artisan('dapodik:eloquent-db-create')
            ->assertExitCode(0);

        $this->assertTrue(File::exists($dbPath));

        File::delete($dbPath);
    }

    /** @test */
    public function does_not_fail_when_sqlite_database_already_exists()
    {
        $dbPath = sys_get_temp_dir().'/dapodik-test-'.uniqid().'.sqlite';
        touch($dbPath);

        Config::set('dapodik-eloquent.connection', 'sqlite_test2');
        Config::set('database.connections.sqlite_test2', [
            'driver' => 'sqlite',
            'database' => $dbPath,
        ]);

        $this->artisan('dapodik:eloquent-db-create')
            ->assertExitCode(0);

        File::delete($dbPath);
    }

    /** @test */
    public function creates_sqlite_database_with_custom_database_option()
    {
        $dbPath = sys_get_temp_dir().'/dapodik-test-'.uniqid().'.sqlite';

        Config::set('dapodik-eloquent.connection', 'sqlite_test3');
        Config::set('database.connections.sqlite_test3', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);

        $this->artisan('dapodik:eloquent-db-create', [
            '--connection' => 'sqlite_test3',
            '--database' => $dbPath,
        ])->assertExitCode(0);

        $this->assertTrue(File::exists($dbPath));

        File::delete($dbPath);
    }

    /** @test */
    public function fails_when_connection_is_not_configured()
    {
        Config::set('dapodik-eloquent.connection', 'nonexistent_connection');

        $this->artisan('dapodik:eloquent-db-create')
            ->assertExitCode(1);
    }

    /** @test */
    public function fails_when_no_database_name_is_specified()
    {
        Config::set('dapodik-eloquent.connection', 'no_db_conn');
        Config::set('database.connections.no_db_conn', [
            'driver' => 'mysql',
        ]);

        $this->artisan('dapodik:eloquent-db-create')
            ->assertExitCode(1);
    }

    /** @test */
    public function creates_sqlite_database_using_relative_path()
    {
        $dbName = 'dapodik-test-'.uniqid().'.sqlite';
        Config::set('dapodik-eloquent.connection', 'sqlite_rel');
        Config::set('database.connections.sqlite_rel', [
            'driver' => 'sqlite',
            'database' => $dbName,
        ]);

        $this->artisan('dapodik:eloquent-db-create')
            ->assertExitCode(0);

        $expectedPath = database_path(Config::get('database.connections.sqlite_rel.database'));
        $this->assertTrue(File::exists($expectedPath));

        File::delete($expectedPath);
    }

    /** @test */
    public function creates_sqlite_database_in_subdirectory()
    {
        $dir = sys_get_temp_dir().'/dapodik-subdir-'.uniqid();
        $dbPath = $dir.'/test.sqlite';

        Config::set('dapodik-eloquent.connection', 'sqlite_sub');
        Config::set('database.connections.sqlite_sub', [
            'driver' => 'sqlite',
            'database' => $dbPath,
        ]);

        $this->artisan('dapodik:eloquent-db-create')
            ->assertExitCode(0);

        $this->assertTrue(File::exists($dbPath));

        File::deleteDirectory($dir);
    }

    /** @test */
    public function creates_all_split_sqlite_databases()
    {
        $dir = sys_get_temp_dir().'/dapodik-split-'.uniqid();
        $dbPath = $dir.'/dapodik.sqlite';

        Config::set('dapodik-eloquent.split_connection', true);
        Config::set('dapodik-eloquent.connection', 'sqlite_split');
        Config::set('database.connections.sqlite_split', [
            'driver' => 'sqlite',
            'database' => $dbPath,
        ]);

        $this->artisan('dapodik:eloquent-db-create')
            ->assertExitCode(0);

        $this->assertTrue(File::exists($dbPath));

        $folders = ['ref', 'man_akses', 'pustaka', 'nilai', 'audit', 'blob', 'eloquent'];
        foreach ($folders as $folder) {
            $splitFile = $dir.'/dapodik_'.$folder.'.sqlite';
            $this->assertTrue(File::exists($splitFile));
        }

        File::deleteDirectory($dir);
    }

    /** @test */
    public function does_not_fail_when_split_sqlite_databases_already_exist()
    {
        $dir = sys_get_temp_dir().'/dapodik-split-existing-'.uniqid();
        $dbPath = $dir.'/dapodik.sqlite';
        mkdir($dir, 0777, true);
        touch($dbPath);

        Config::set('dapodik-eloquent.split_connection', true);
        Config::set('dapodik-eloquent.connection', 'sqlite_split_existing');
        Config::set('database.connections.sqlite_split_existing', [
            'driver' => 'sqlite',
            'database' => $dbPath,
        ]);

        $this->artisan('dapodik:eloquent-db-create')
            ->assertExitCode(0);

        File::deleteDirectory($dir);
    }
}
