<?php

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentPublishCommand;
use Illuminate\Support\Facades\File;

it('verifies the model publish command is available', function () {
    $this->assertTrue(class_exists(DapodikEloquentPublishCommand::class));
});

it('can publish all models using artisan', function () {
    $modelsPath = app_path('Models/Dapodik');

    File::deleteDirectory($modelsPath);

    $this->artisan('dapodik:eloquent-publish')
        ->assertExitCode(0);

    $agamaFile = $modelsPath.'/Ref/Agama.php';
    $this->assertTrue(File::exists($agamaFile));

    $content = File::get($agamaFile);
    $this->assertStringContainsString('namespace App\\Models\\Dapodik\\Ref;', $content);
    $this->assertStringContainsString('class Agama extends BaseAgama', $content);

    File::deleteDirectory($modelsPath);
});

it('can publish a single model using artisan', function () {
    $modelsPath = app_path('Models/Dapodik');

    File::deleteDirectory($modelsPath);

    $this->artisan('dapodik:eloquent-publish', ['model' => 'agama'])
        ->assertExitCode(0);

    $agamaFile = $modelsPath.'/Ref/Agama.php';
    $this->assertTrue(File::exists($agamaFile));

    $otherFile = $modelsPath.'/Ref/Akreditasi.php';
    $this->assertFalse(File::exists($otherFile));

    File::deleteDirectory($modelsPath);
});

it('fails when model is not found', function () {
    $this->artisan('dapodik:eloquent-publish', ['model' => 'non_existent_model'])
        ->assertExitCode(1);
});

it('can republish model with force flag', function () {
    $modelsPath = app_path('Models/Dapodik');

    File::deleteDirectory($modelsPath);

    $this->artisan('dapodik:eloquent-publish', ['model' => 'agama'])
        ->assertExitCode(0);

    $agamaFile = $modelsPath.'/Ref/Agama.php';
    $originalContent = File::get($agamaFile);

    $this->artisan('dapodik:eloquent-publish', ['model' => 'agama', '--force' => true])
        ->assertExitCode(0);

    $newContent = File::get($agamaFile);
    $this->assertEquals($originalContent, $newContent);

    File::deleteDirectory($modelsPath);
});
