<?php

namespace Dapodik\Laravel\Eloquent\Tests\Unit;

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModelStructureTest extends TestCase
{
    private $schemaDirs;
    private $schemaNs;
    private $rootDir;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rootDir = __DIR__.'/../../../src/laravel/Eloquent/Models';

        $this->schemaDirs = [
            'ref' => $this->rootDir.'/Ref',
            'man_akses' => $this->rootDir.'/ManAkses',
            'pustaka' => $this->rootDir.'/Pustaka',
            'nilai' => $this->rootDir.'/Nilai',
            'audit' => $this->rootDir.'/Audit',
            'blob' => $this->rootDir.'/Blob',
            'eloquent' => $this->rootDir.'/Eloquent',
        ];

        $this->schemaNs = [
            'ref' => 'Dapodik\\Laravel\\Eloquent\\Models\\Ref',
            'man_akses' => 'Dapodik\\Laravel\\Eloquent\\Models\\ManAkses',
            'pustaka' => 'Dapodik\\Laravel\\Eloquent\\Models\\Pustaka',
            'nilai' => 'Dapodik\\Laravel\\Eloquent\\Models\\Nilai',
            'audit' => 'Dapodik\\Laravel\\Eloquent\\Models\\Audit',
            'blob' => 'Dapodik\\Laravel\\Eloquent\\Models\\Blob',
            'eloquent' => 'Dapodik\\Laravel\\Eloquent\\Models\\Eloquent',
        ];
    }

    private function getModelFqcns()
    {
        foreach ($this->schemaDirs as $key => $dir) {
            if (!is_dir($dir)) {
                continue;
            }

            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));

            foreach ($iterator as $file) {
                if ($file->getExtension() !== 'php') {
                    continue;
                }

                yield $this->schemaNs[$key].'\\'.$file->getBasename('.php');
            }
        }

        foreach (glob($this->rootDir.'/*.php') as $file) {
            yield 'Dapodik\\Laravel\\Eloquent\\Models\\'.basename($file, '.php');
        }
    }

    private function hasOwnConstant($class, $const)
    {
        try {
            $rc = new \ReflectionClass($class);

            if (!$rc->hasConstant($const)) {
                return false;
            }

            $declarer = $rc->getReflectionConstant($const)->getDeclaringClass()->getName();

            return $declarer === $class;
        } catch (\ReflectionException $e) {
            return false;
        }
    }

    /** @test */
    public function all_model_classes_exist_and_extend_model()
    {
        $count = 0;

        foreach ($this->getModelFqcns() as $fqcn) {
            $this->assertTrue(class_exists($fqcn), "Class {$fqcn} not found");
            $this->assertInstanceOf(Model::class, new $fqcn());
            $count++;
        }

        $this->assertGreaterThanOrEqual(269, $count);
    }

    /** @test */
    public function all_models_use_has_connection_trait()
    {
        foreach ($this->getModelFqcns() as $fqcn) {
            $traits = class_uses_recursive($fqcn);
            $this->assertTrue(in_array(HasConnection::class, $traits), "{$fqcn} does not use HasConnection");
        }
    }

    /** @test */
    public function all_models_have_a_primary_key()
    {
        foreach ($this->getModelFqcns() as $fqcn) {
            $instance = new $fqcn();
            $this->assertNotEmpty($instance->getKeyName(), "{$fqcn} has empty primaryKey");
        }
    }

    /** @test */
    public function ref_schema_timestamp_constants()
    {
        foreach ($this->getModelFqcns() as $fqcn) {
            $ns = (new \ReflectionClass($fqcn))->getNamespaceName();

            if (substr($ns, -4) !== '\\Ref') {
                continue;
            }

            $instance = new $fqcn();

            if ($this->hasOwnConstant($fqcn, 'CREATED_AT')) {
                $this->assertEquals('create_date', $instance->getCreatedAtColumn(), "{$fqcn} CREATED_AT");
            }
            if ($this->hasOwnConstant($fqcn, 'UPDATED_AT')) {
                $this->assertEquals('last_update', $instance->getUpdatedAtColumn(), "{$fqcn} UPDATED_AT");
            }
            if ($this->hasOwnConstant($fqcn, 'DELETED_AT')) {
                $this->assertEquals('expired_date', $instance->getDeletedAtColumn(), "{$fqcn} DELETED_AT");
            }
        }
    }

    /** @test */
    public function public_schema_deleted_at_constant()
    {
        $customSoftDelete = ['author', 'pesan'];

        foreach ($this->getModelFqcns() as $fqcn) {
            $ns = (new \ReflectionClass($fqcn))->getNamespaceName();

            if ($ns !== 'Dapodik\\Laravel\\Eloquent\\Models') {
                continue;
            }

            $basename = (new \ReflectionClass($fqcn))->getShortName();
            $instance = new $fqcn();

            if ($this->hasOwnConstant($fqcn, 'DELETED_AT')) {
                $shortName = Str::snake($basename);
                $expected = in_array($shortName, $customSoftDelete) ? 'expired_date' : 'soft_delete';
                $this->assertEquals($expected, $instance->getDeletedAtColumn(), "{$fqcn} DELETED_AT");
            }
        }
    }

    /** @test */
    public function man_akses_schema_constants()
    {
        $softDeleteModels = ['log_otentikasi', 'log_otorisasi', 'pengguna'];

        foreach ($this->getModelFqcns() as $fqcn) {
            $ns = (new \ReflectionClass($fqcn))->getNamespaceName();

            if (substr($ns, -9) !== '\\ManAkses') {
                continue;
            }

            $basename = (new \ReflectionClass($fqcn))->getShortName();
            $instance = new $fqcn();
            $shortName = Str::snake($basename);

            if ($this->hasOwnConstant($fqcn, 'CREATED_AT')) {
                $this->assertEquals('create_date', $instance->getCreatedAtColumn(), "{$fqcn} CREATED_AT");
            }
            if ($this->hasOwnConstant($fqcn, 'UPDATED_AT')) {
                $this->assertEquals('last_update', $instance->getUpdatedAtColumn(), "{$fqcn} UPDATED_AT");
            }
            if ($this->hasOwnConstant($fqcn, 'DELETED_AT')) {
                $expected = in_array($shortName, $softDeleteModels) ? 'soft_delete' : 'expired_date';
                $this->assertEquals($expected, $instance->getDeletedAtColumn(), "{$fqcn} DELETED_AT");
            }
        }
    }

    /** @test */
    public function pustaka_schema_constants()
    {
        foreach ($this->getModelFqcns() as $fqcn) {
            $ns = (new \ReflectionClass($fqcn))->getNamespaceName();

            if (substr($ns, -8) !== '\\Pustaka') {
                continue;
            }

            $instance = new $fqcn();

            if ($this->hasOwnConstant($fqcn, 'CREATED_AT')) {
                $this->assertEquals('create_date', $instance->getCreatedAtColumn());
            }
            if ($this->hasOwnConstant($fqcn, 'UPDATED_AT')) {
                $this->assertEquals('last_update', $instance->getUpdatedAtColumn());
            }
            if ($this->hasOwnConstant($fqcn, 'DELETED_AT')) {
                $this->assertEquals('expired_date', $instance->getDeletedAtColumn());
            }
        }
    }

    /** @test */
    public function nilai_schema_constants()
    {
        foreach ($this->getModelFqcns() as $fqcn) {
            $ns = (new \ReflectionClass($fqcn))->getNamespaceName();

            if (substr($ns, -6) !== '\\Nilai') {
                continue;
            }

            $instance = new $fqcn();

            if ($this->hasOwnConstant($fqcn, 'CREATED_AT')) {
                $this->assertEquals('create_date', $instance->getCreatedAtColumn());
            }
            if ($this->hasOwnConstant($fqcn, 'UPDATED_AT')) {
                $this->assertEquals('last_update', $instance->getUpdatedAtColumn());
            }
            if ($this->hasOwnConstant($fqcn, 'DELETED_AT')) {
                $this->assertEquals('soft_delete', $instance->getDeletedAtColumn());
            }
        }
    }

    /** @test */
    public function blob_schema_large_object_constants()
    {
        $fqcn = $this->schemaNs['blob'].'\\LargeObject';
        $instance = new $fqcn();
        $this->assertEquals('create_date', $instance->getCreatedAtColumn());
        $this->assertEquals('last_update', $instance->getUpdatedAtColumn());
        $this->assertEquals('soft_delete', $instance->getDeletedAtColumn());
    }

    /** @test */
    public function audit_schema_logged_actions_has_no_own_timestamp_constants()
    {
        $fqcn = $this->schemaNs['audit'].'\\LoggedActions';
        $this->assertFalse($this->hasOwnConstant($fqcn, 'CREATED_AT'));
        $this->assertFalse($this->hasOwnConstant($fqcn, 'UPDATED_AT'));
        $this->assertFalse($this->hasOwnConstant($fqcn, 'DELETED_AT'));
        $this->assertFalse((new $fqcn())->timestamps);
    }

    /** @test */
    public function models_resolve_table_name_correctly()
    {
        config()->set('dapodik-eloquent', require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php');

        $overridden = [
            'Dapodik\\Laravel\\Eloquent\\Models\\Pustaka\\Author',
        ];

        foreach ($this->getModelFqcns() as $fqcn) {
            if (in_array($fqcn, $overridden, true)) {
                continue;
            }

            $instance = new $fqcn();
            $table = $instance->getTable();
            $this->assertStringContainsString('dapodik_', $table);
        }
    }

    /** @test */
    public function models_resolve_connection_name()
    {
        config()->set('dapodik-eloquent', require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php');

        foreach ($this->getModelFqcns() as $fqcn) {
            $instance = new $fqcn();
            $connection = $instance->getConnectionName();
            $this->assertNotEmpty($connection);
        }
    }
}
