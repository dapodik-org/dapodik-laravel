<?php

// Quick autoload test without Laravel framework boot

require_once __DIR__.'/../../vendor/autoload.php';

$classes = [
    // Core
    \Dapodik\Laravel\Eloquent\EloquentServiceProvider::class,
    \Dapodik\Laravel\Eloquent\EloquentManager::class,
    \Dapodik\Laravel\Eloquent\Model::class,
    \Dapodik\Laravel\Eloquent\Migration::class,
    \Dapodik\Laravel\Eloquent\Facades\Eloquent::class,
    \Dapodik\Laravel\Eloquent\Concerns\HasConnection::class,
    \Dapodik\Laravel\Eloquent\Concerns\HasCompositeKey::class,
    \Dapodik\Laravel\Eloquent\Commands\DapodikEloquentPublishCommand::class,
    \Dapodik\Laravel\Eloquent\Commands\DapodikEloquentDatabaseCreateCommand::class,
    // Enums → Types
    \Dapodik\Laravel\Eloquent\Types\JenisKelamin::class,
    \Dapodik\Laravel\Eloquent\Types\PosisiGelar::class,
    \Dapodik\Laravel\Eloquent\Types\StatusPerkawinan::class,
    \Dapodik\Laravel\Eloquent\Types\StatusSekolah::class,
    // Models - Ref
    \Dapodik\Laravel\Eloquent\Models\Ref\Agama::class,
    \Dapodik\Laravel\Eloquent\Models\Ref\BentukPendidikan::class,
    \Dapodik\Laravel\Eloquent\Models\Ref\MstWilayah::class,
    \Dapodik\Laravel\Eloquent\Models\Ref\Jurusan::class,
    // Models - Root (ex-Publik)
    \Dapodik\Laravel\Eloquent\Models\Sekolah::class,
    \Dapodik\Laravel\Eloquent\Models\Ptk::class,
    \Dapodik\Laravel\Eloquent\Models\PesertaDidik::class,
    \Dapodik\Laravel\Eloquent\Models\RombonganBelajar::class,
    \Dapodik\Laravel\Eloquent\Models\Pembelajaran::class,
    \Dapodik\Laravel\Eloquent\Models\AnggotaRombel::class,
    \Dapodik\Laravel\Eloquent\Models\Yayasan::class,
    \Dapodik\Laravel\Eloquent\Models\SyncLog::class,
    // Models - ManAkses
    \Dapodik\Laravel\Eloquent\Models\ManAkses\Pengguna::class,
    \Dapodik\Laravel\Eloquent\Models\ManAkses\Peran::class,
    \Dapodik\Laravel\Eloquent\Models\ManAkses\Aplikasi::class,
    // Models - Nilai
    \Dapodik\Laravel\Eloquent\Models\Nilai\NilaiRapor::class,
    \Dapodik\Laravel\Eloquent\Models\Nilai\Un::class,
    // Models - Pustaka
    \Dapodik\Laravel\Eloquent\Models\Pustaka\Biblio::class,
    \Dapodik\Laravel\Eloquent\Models\Pustaka\Publisher::class,
    // Models - Audit & Blob & Eloquent
    \Dapodik\Laravel\Eloquent\Models\Audit\LoggedActions::class,
    \Dapodik\Laravel\Eloquent\Models\Blob\LargeObject::class,
    \Dapodik\Laravel\Eloquent\Models\Eloquent\SyncStatus::class,
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
