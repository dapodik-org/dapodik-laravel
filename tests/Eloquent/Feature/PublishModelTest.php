<?php

namespace Dapodik\Laravel\Eloquent\Tests\Feature;

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentPublishCommand;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Support\Facades\File;

class PublishModelTest extends TestCase
{
    /** @test */
    public function verifies_the_model_publish_command_is_available()
    {
        $this->assertTrue(class_exists(DapodikEloquentPublishCommand::class));
    }

    /** @test */
    public function can_publish_all_models_using_artisan()
    {
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
    }

    /** @test */
    public function can_publish_a_single_model_using_artisan()
    {
        $modelsPath = app_path('Models/Dapodik');

        File::deleteDirectory($modelsPath);

        $this->artisan('dapodik:eloquent-publish', ['model' => 'agama'])
            ->assertExitCode(0);

        $agamaFile = $modelsPath.'/Ref/Agama.php';
        $this->assertTrue(File::exists($agamaFile));

        $otherFile = $modelsPath.'/Ref/Akreditasi.php';
        $this->assertFalse(File::exists($otherFile));

        File::deleteDirectory($modelsPath);
    }

    /** @test */
    public function fails_when_model_is_not_found()
    {
        $this->artisan('dapodik:eloquent-publish', ['model' => 'non_existent_model'])
            ->assertExitCode(1);
    }

    /** @test */
    public function can_republish_model_with_force_flag()
    {
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
    }
}
