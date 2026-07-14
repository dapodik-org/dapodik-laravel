<?php

use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\Models\AnggotaRombel;
use Dapodik\Laravel\Eloquent\Models\Audit\LoggedActions;
use Dapodik\Laravel\Eloquent\Models\Blob\LargeObject;
use Dapodik\Laravel\Eloquent\Models\Eloquent\SyncStatus;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Aplikasi;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Menu;
use Dapodik\Laravel\Eloquent\Models\ManAkses\MenuRole;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Pengguna;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Peran;
use Dapodik\Laravel\Eloquent\Models\ManAkses\RolePengguna;
use Dapodik\Laravel\Eloquent\Models\Nilai\NilaiRapor;
use Dapodik\Laravel\Eloquent\Models\Nilai\NilaiSmt;
use Dapodik\Laravel\Eloquent\Models\Nilai\Un;
use Dapodik\Laravel\Eloquent\Models\Pembelajaran;
use Dapodik\Laravel\Eloquent\Models\PesertaDidik;
use Dapodik\Laravel\Eloquent\Models\Ptk;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Biblio;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Publisher;
use Dapodik\Laravel\Eloquent\Models\Ref\Agama;
use Dapodik\Laravel\Eloquent\Models\Ref\BentukPendidikan;
use Dapodik\Laravel\Eloquent\Models\Ref\Jurusan;
use Dapodik\Laravel\Eloquent\Models\Ref\MstWilayah;
use Dapodik\Laravel\Eloquent\Models\RombonganBelajar;
use Dapodik\Laravel\Eloquent\Models\Sekolah;
use Dapodik\Laravel\Eloquent\Models\SyncLog;
use Dapodik\Laravel\Eloquent\Models\Yayasan;
use Illuminate\Database\Eloquent\Model;

beforeEach(function () {
    $this->rootDir = __DIR__.'/../../../src/laravel/Eloquent/Models';

    $this->schemaDirs = [
        'ref' => $this->rootDir.'/Ref',
        'man_akses' => $this->rootDir.'/ManAkses',
        'pustaka' => $this->rootDir.'/Pustaka',
        'nilai' => $this->rootDir.'/Nilai',
        'audit' => $this->rootDir.'/Audit',
        'blob' => $this->rootDir.'/Blob',
    ];

    $this->schemaNs = [
        'ref' => 'Ref',
        'man_akses' => 'ManAkses',
        'pustaka' => 'Pustaka',
        'nilai' => 'Nilai',
        'audit' => 'Audit',
        'blob' => 'Blob',
    ];
});

it('all model classes exist and extend model', function () {
    $modelFiles = array_merge(
        [$this->rootDir.'/Sekolah.php', $this->rootDir.'/Ptk.php', $this->rootDir.'/PesertaDidik.php',
            $this->rootDir.'/RombonganBelajar.php', $this->rootDir.'/Pembelajaran.php', $this->rootDir.'/AnggotaRombel.php',
            $this->rootDir.'/Yayasan.php', $this->rootDir.'/SyncLog.php'],
        glob($this->rootDir.'/Ref/*.php'),
        glob($this->rootDir.'/ManAkses/*.php'),
        glob($this->rootDir.'/Pustaka/*.php'),
        glob($this->rootDir.'/Nilai/*.php'),
        glob($this->rootDir.'/Audit/*.php'),
        glob($this->rootDir.'/Blob/*.php'),
        glob($this->rootDir.'/Eloquent/*.php'),
    );

    $modelsToTest = [];

    foreach ($modelFiles as $file) {
        $relativePath = str_replace($this->rootDir.'/', '', $file);
        $relativePath = str_replace('.php', '', $relativePath);
        $className = 'Dapodik\\Laravel\\Eloquent\\Models\\'.str_replace('/', '\\', $relativePath);

        if (class_exists($className)) {
            $reflection = new ReflectionClass($className);
            if ($reflection->isInstantiable() && $reflection->isSubclassOf(Model::class)) {
                $modelsToTest[] = $className;
            }
        }
    }

    $this->assertNotEmpty($modelsToTest);

    foreach ($modelsToTest as $modelClass) {
        $model = new $modelClass;
        $this->assertInstanceOf(Model::class, $model);
    }
});

it('all models use has connection trait', function () {
    $modelFiles = array_merge(
        [$this->rootDir.'/Sekolah.php', $this->rootDir.'/Ptk.php', $this->rootDir.'/PesertaDidik.php',
            $this->rootDir.'/RombonganBelajar.php', $this->rootDir.'/Pembelajaran.php', $this->rootDir.'/AnggotaRombel.php',
            $this->rootDir.'/Yayasan.php', $this->rootDir.'/SyncLog.php'],
        glob($this->rootDir.'/Ref/*.php'),
        glob($this->rootDir.'/ManAkses/*.php'),
        glob($this->rootDir.'/Pustaka/*.php'),
        glob($this->rootDir.'/Nilai/*.php'),
        glob($this->rootDir.'/Audit/*.php'),
        glob($this->rootDir.'/Blob/*.php'),
        glob($this->rootDir.'/Eloquent/*.php'),
    );

    $modelsWithoutTrait = [];

    foreach ($modelFiles as $file) {
        $relativePath = str_replace($this->rootDir.'/', '', $file);
        $relativePath = str_replace('.php', '', $relativePath);
        $className = 'Dapodik\\Laravel\\Eloquent\\Models\\'.str_replace('/', '\\', $relativePath);

        if (class_exists($className)) {
            $reflection = new ReflectionClass($className);
            if ($reflection->isInstantiable() && $reflection->isSubclassOf(Model::class)) {
                if (! in_array(HasConnection::class, class_uses_recursive($className))) {
                    $modelsWithoutTrait[] = $className;
                }
            }
        }
    }

    $this->assertEmpty($modelsWithoutTrait, 'Models missing HasConnection trait: '.implode(', ', $modelsWithoutTrait));
});

it('all models have a primary key', function () {
    $model = new Sekolah;
    $this->assertNotNull($model->getKeyName());

    $model = new Ptk;
    $this->assertNotNull($model->getKeyName());

    $model = new PesertaDidik;
    $this->assertNotNull($model->getKeyName());

    $model = new Agama;
    $this->assertNotNull($model->getKeyName());

    $model = new BentukPendidikan;
    $this->assertNotNull($model->getKeyName());

    $model = new MstWilayah;
    $this->assertNotNull($model->getKeyName());

    $model = new Jurusan;
    $this->assertNotNull($model->getKeyName());

    $model = new RombonganBelajar;
    $this->assertNotNull($model->getKeyName());

    $model = new Pembelajaran;
    $this->assertNotNull($model->getKeyName());

    $model = new AnggotaRombel;
    $this->assertNotNull($model->getKeyName());

    $model = new Yayasan;
    $this->assertNotNull($model->getKeyName());

    $model = new SyncLog;
    $this->assertNotNull($model->getKeyName());
});

test('ref schema timestamp constants', function () {
    $model = new Agama;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());
    $this->assertEquals('expired_date', (new ReflectionClass($model))->getMethod('getDeletedAtColumn')->invoke($model));
});

test('public schema deleted at constant', function () {
    $model = new Sekolah;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());
    $this->assertEquals('soft_delete', (new ReflectionClass($model))->getMethod('getDeletedAtColumn')->invoke($model));
});

test('man akses schema constants', function () {
    $model = new Pengguna;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());

    $model = new Peran;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());

    $model = new Aplikasi;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());

    $model = new Menu;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());

    $model = new MenuRole;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());

    $model = new RolePengguna;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());
});

test('pustaka schema constants', function () {
    $model = new Biblio;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());

    $model = new Publisher;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());
});

test('nilai schema constants', function () {
    $model = new NilaiRapor;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());

    $model = new NilaiSmt;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());

    $model = new Un;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());
});

test('blob schema large object constants', function () {
    $model = new LargeObject;
    $this->assertEquals('create_date', $model->getCreatedAtColumn());
    $this->assertEquals('last_update', $model->getUpdatedAtColumn());
});

test('audit schema logged actions has no own timestamp constants', function () {
    $model = new LoggedActions;
    $this->assertEquals('created_at', $model->getCreatedAtColumn());
});

it('models resolve table name correctly', function () {
    $tests = [
        ['model' => new Agama, 'expected' => 'dapodik_ref_agama'],
        ['model' => new BentukPendidikan, 'expected' => 'dapodik_ref_bentuk_pendidikan'],
        ['model' => new MstWilayah, 'expected' => 'dapodik_ref_mst_wilayah'],
        ['model' => new Jurusan, 'expected' => 'dapodik_ref_jurusan'],
        ['model' => new Sekolah, 'expected' => 'dapodik_sekolah'],
        ['model' => new Ptk, 'expected' => 'dapodik_ptk'],
        ['model' => new PesertaDidik, 'expected' => 'dapodik_peserta_didik'],
        ['model' => new RombonganBelajar, 'expected' => 'dapodik_rombongan_belajar'],
        ['model' => new Pembelajaran, 'expected' => 'dapodik_pembelajaran'],
        ['model' => new AnggotaRombel, 'expected' => 'dapodik_anggota_rombel'],
        ['model' => new Yayasan, 'expected' => 'dapodik_yayasan'],
        ['model' => new SyncLog, 'expected' => 'dapodik_sync_log'],
        ['model' => new Pengguna, 'expected' => 'dapodik_man_akses_pengguna'],
        ['model' => new Peran, 'expected' => 'dapodik_man_akses_peran'],
        ['model' => new Aplikasi, 'expected' => 'dapodik_man_akses_aplikasi'],
        ['model' => new NilaiRapor, 'expected' => 'dapodik_nilai_nilai_rapor'],
        ['model' => new Un, 'expected' => 'dapodik_nilai_un'],
        ['model' => new Biblio, 'expected' => 'dapodik_pustaka_biblio'],
        ['model' => new Publisher, 'expected' => 'dapodik_pustaka_publisher'],
        ['model' => new LoggedActions, 'expected' => 'dapodik_audit_logged_actions'],
        ['model' => new LargeObject, 'expected' => 'dapodik_blob_large_object'],
        ['model' => new SyncStatus, 'expected' => 'dapodik_eloquent_sync_status'],
    ];

    foreach ($tests as $test) {
        $this->assertEquals($test['expected'], $test['model']->getTable(), 'Table name mismatch for '.get_class($test['model']));
    }
});

it('models resolve connection name', function () {
    $tests = [
        Agama::class,
        BentukPendidikan::class,
        MstWilayah::class,
        Jurusan::class,
        Sekolah::class,
        Ptk::class,
        PesertaDidik::class,
        RombonganBelajar::class,
        Pembelajaran::class,
        AnggotaRombel::class,
        Yayasan::class,
        SyncLog::class,
        Pengguna::class,
        Peran::class,
        Aplikasi::class,
        NilaiRapor::class,
        Un::class,
        Biblio::class,
        Publisher::class,
        LoggedActions::class,
        LargeObject::class,
        SyncStatus::class,
    ];

    foreach ($tests as $modelClass) {
        $model = new $modelClass;
        $connection = $model->getConnectionName();
        $this->assertNotNull($connection, "Connection name is null for {$modelClass}");
        $this->assertIsString($connection, "Connection name is not a string for {$modelClass}");
    }
});
