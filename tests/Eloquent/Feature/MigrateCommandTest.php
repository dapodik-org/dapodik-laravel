<?php

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentMigrateCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    $this->publishedMigrationsPath = $this->app->databasePath('migrations/dapodik');

    $this->packageMigrationsPath = realpath(__DIR__.'/../../../src/laravel/Eloquent/database/migrations/dapodik');

    if (! is_dir($this->publishedMigrationsPath)) {
        mkdir($this->publishedMigrationsPath, 0755, true);
    }

    foreach (glob($this->publishedMigrationsPath.'/*.php') as $file) {
        File::delete($file);
    }

    config()->set('dapodik-eloquent.auto_load_migrations', false);
    config()->set('dapodik-eloquent.exclude_tables', []);
});

afterEach(function () {
    if (Schema::hasTable('migrations')) {
        DB::table('migrations')->where('migration', 'like', '%_create_dapodik_%')->delete();
    }

    foreach (glob($this->publishedMigrationsPath.'/*.php') as $file) {
        File::delete($file);
    }
});

it('verifies the migrate command class exists', function () {
    expect(class_exists(DapodikEloquentMigrateCommand::class))->toBeTrue();
});

it('runs dapodik migrations only via the command from package path', function () {
    $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));

    $this->artisan('dapodik:migrate')->assertExitCode(0);

    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
    $this->assertTrue(Schema::hasTable('dapodik_ref_akreditasi'));
});

it('does not touch non-dapodik tables when running', function () {
    Schema::create('custom_user_table', function ($table) {
        $table->id();
        $table->string('name');
    });

    $this->artisan('dapodik:migrate')->assertExitCode(0);

    $this->assertTrue(Schema::hasTable('custom_user_table'));
    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
});

it('drops and recreates tables when --fresh is used', function () {
    $this->artisan('dapodik:migrate')->assertExitCode(0);

    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));

    Schema::table('dapodik_ref_agama', function ($table) {
        $table->dropColumn('nama');
    });

    $this->assertFalse(Schema::hasColumn('dapodik_ref_agama', 'nama'));

    $this->artisan('dapodik:migrate', ['--fresh' => true])->assertExitCode(0);

    $this->assertTrue(Schema::hasColumn('dapodik_ref_agama', 'nama'));
});

it('uses the --database option to override connection', function () {
    $this->artisan('dapodik:migrate', ['--database' => 'testing'])->assertExitCode(0);

    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));
});

it('fails when migrations path does not exist', function () {
    $this->artisan('dapodik:migrate', ['--path' => '/non/existent/path'])->assertExitCode(1);
});

it('can run pretend mode without executing migrations', function () {
    $this->artisan('dapodik:migrate', ['--pretend' => true])->assertExitCode(0);

    $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
});

it('does not run migrate when auto_load_migrations is false and php artisan migrate is called', function () {
    $this->artisan('migrate')->assertExitCode(0);

    expect(Schema::hasTable('dapodik_ref_agama'))->toBeFalse();
});

it('migrates dapodik tables after artisan migrate has run', function () {
    $this->artisan('migrate')->assertExitCode(0);

    expect(Schema::hasTable('dapodik_ref_agama'))->toBeFalse();

    $this->artisan('dapodik:migrate')->assertExitCode(0);

    expect(Schema::hasTable('dapodik_ref_agama'))->toBeTrue();
});
