<?php

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentPublishMigrationCommand;
use Illuminate\Support\Facades\File;

function assertIsStandardLaravelMigration($content)
{
    expect($content)
        ->toContain('use Illuminate\\Database\\Migrations\\Migration;')
        ->toContain('use Illuminate\\Support\\Facades\\Schema;')
        ->not->toContain('use Dapodik\\Laravel\\Eloquent\\Migration;')
        ->not->toContain('protected $model =')
        ->not->toContain('$this->createSchemaIfNotExist()')
        ->toContain('Schema::create(')
        ->toContain('Schema::dropIfExists(');
}

afterEach(function () {
    $files = glob(database_path('migrations/*_create_dapodik_*.php'))
        ?: [];
    $files = array_merge($files, glob(database_path('migrations/*_add_*_to_*.php')) ?: []);
    foreach ($files as $file) {
        File::delete($file);
    }
});

it('publishes and transforms migrations via artisan command', function () {
    $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'agama'])
        ->assertExitCode(0);

    $published = glob(database_path('migrations/*create_dapodik_agama_table.php'));

    expect($published)->not->toBeEmpty();

    $content = File::get($published[0]);
    assertIsStandardLaravelMigration($content);
});

it('verifies the migration publish command class exists', function () {
    expect(class_exists(DapodikEloquentPublishMigrationCommand::class))->toBeTrue();
});

it('can publish all migrations using artisan', function () {
    $this->artisan('dapodik:eloquent-publish-migration')
        ->assertExitCode(0);

    $agamaFile = glob(database_path('migrations/*create_dapodik_agama_table.php'));
    expect($agamaFile)->not->toBeEmpty();

    $content = File::get($agamaFile[0]);
    assertIsStandardLaravelMigration($content);
});

it('can publish a single migration using artisan', function () {
    $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'agama'])
        ->assertExitCode(0);

    $agamaFile = glob(database_path('migrations/*create_dapodik_agama_table.php'));
    expect($agamaFile)->not->toBeEmpty();

    $akreditasiFile = glob(database_path('migrations/*create_dapodik_akreditasi_table.php'));
    expect($akreditasiFile)->toBeEmpty();

    $content = File::get($agamaFile[0]);
    assertIsStandardLaravelMigration($content);
});

it('fails when migration is not found', function () {
    $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'non_existent_migration'])
        ->assertExitCode(1);
});

it('can republish migration with force flag', function () {
    $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'agama'])
        ->assertExitCode(0);

    $agamaFile = glob(database_path('migrations/*create_dapodik_agama_table.php'));
    expect($agamaFile)->not->toBeEmpty();

    $originalContent = File::get($agamaFile[0]);

    $this->artisan('dapodik:eloquent-publish-migration', ['migration' => 'agama', '--force' => true])
        ->assertExitCode(0);

    $newContent = File::get($agamaFile[0]);

    expect($newContent)->toEqual($originalContent);
    assertIsStandardLaravelMigration($newContent);
});
