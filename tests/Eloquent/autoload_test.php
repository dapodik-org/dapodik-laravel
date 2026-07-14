<?php

use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentDatabaseCreateCommand;
use Dapodik\Laravel\Eloquent\Commands\DapodikEloquentPublishCommand;
use Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey;
use Dapodik\Laravel\Eloquent\Concerns\HasConnection;
use Dapodik\Laravel\Eloquent\EloquentManager;
use Dapodik\Laravel\Eloquent\EloquentServiceProvider;
use Dapodik\Laravel\Eloquent\Enums\JenisKelamin;
use Dapodik\Laravel\Eloquent\Enums\PosisiGelar;
use Dapodik\Laravel\Eloquent\Enums\StatusPerkawinan;
use Dapodik\Laravel\Eloquent\Enums\StatusSekolah;
use Dapodik\Laravel\Eloquent\Facades\Eloquent;
use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Model;
use Dapodik\Laravel\Eloquent\Models\AnggotaRombel;
use Dapodik\Laravel\Eloquent\Models\Audit\LoggedActions;
use Dapodik\Laravel\Eloquent\Models\Blob\LargeObject;
use Dapodik\Laravel\Eloquent\Models\Eloquent\SyncStatus;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Aplikasi;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Pengguna;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Peran;
use Dapodik\Laravel\Eloquent\Models\Nilai\NilaiRapor;
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

// Quick autoload test without Laravel framework boot

require_once __DIR__.'/../../vendor/autoload.php';

$classes = [
    // Core
    EloquentServiceProvider::class,
    EloquentManager::class,
    Model::class,
    Migration::class,
    Eloquent::class,
    HasConnection::class,
    HasCompositeKey::class,
    DapodikEloquentPublishCommand::class,
    DapodikEloquentDatabaseCreateCommand::class,
    // Enums → Types
    JenisKelamin::class,
    PosisiGelar::class,
    StatusPerkawinan::class,
    StatusSekolah::class,
    // Models - Ref
    Agama::class,
    BentukPendidikan::class,
    MstWilayah::class,
    Jurusan::class,
    // Models - Root (ex-Publik)
    Sekolah::class,
    Ptk::class,
    PesertaDidik::class,
    RombonganBelajar::class,
    Pembelajaran::class,
    AnggotaRombel::class,
    Yayasan::class,
    SyncLog::class,
    // Models - ManAkses
    Pengguna::class,
    Peran::class,
    Aplikasi::class,
    // Models - Nilai
    NilaiRapor::class,
    Un::class,
    // Models - Pustaka
    Biblio::class,
    Publisher::class,
    // Models - Audit & Blob & Eloquent
    LoggedActions::class,
    LargeObject::class,
    SyncStatus::class,
];

$ok = 0;
$fail = 0;

echo 'Testing autoload of '.count($classes)." classes...\n\n";

foreach ($classes as $class) {
    if (class_exists($class)) {
        echo "  OK: $class\n";
        $ok++;
    } else {
        echo "  FAIL: $class\n";
        $fail++;
    }
}

echo "\n---\n";
echo 'Migration files: '.count(glob(__DIR__.'/../../src/laravel/Eloquent/database/migrations/dapodik/*.php'))."\n";
echo 'Model files: '.count(glob(__DIR__.'/../../src/laravel/Eloquent/Models/**/*.php'))."\n";
echo "\nResult: $ok OK, $fail FAIL\n";

exit($fail > 0 ? 1 : 0);
