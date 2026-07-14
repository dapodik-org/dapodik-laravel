<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    config()->set('dapodik-eloquent', require __DIR__.'/../../../src/laravel/Eloquent/config/dapodik-eloquent.php');

    $this->migrationsPath = database_path('migrations/dapodik');

    File::ensureDirectoryExists($this->migrationsPath);

    $existing = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
    foreach ($existing as $file) {
        File::delete($file);
    }

    $this->artisan('vendor:publish', ['--tag' => 'dapodik-eloquent-migrations'])
        ->assertExitCode(0);
});

afterEach(function () {
    $existing = glob($this->migrationsPath.'/*_create_dapodik_*_table.php');
    foreach ($existing as $file) {
        File::delete($file);
    }
});

it('runs all ref schema migrations', function () {
    $this->artisan('migrate')->assertExitCode(0);

    $refTables = [
        'dapodik_ref_agama',
        'dapodik_ref_akreditasi',
        'dapodik_ref_kurikulum',
        'dapodik_ref_semester',
        'dapodik_ref_mst_wilayah',
        'dapodik_ref_jenis_ptk',
        'dapodik_ref_bentuk_pendidikan',
        'dapodik_ref_bidang_studi',
        'dapodik_ref_kompetensi',
    ];

    foreach ($refTables as $table) {
        $this->assertTrue(Schema::hasTable($table), "Table {$table} not found after migrate");
    }
});

it('runs all public schema migrations', function () {
    $this->artisan('migrate')->assertExitCode(0);

    $publicTables = [
        'dapodik_sekolah',
        'dapodik_ptk',
        'dapodik_peserta_didik',
        'dapodik_yayasan',
        'dapodik_rombongan_belajar',
        'dapodik_anggota_rombel',
        'dapodik_pembelajaran',
        'dapodik_ruang',
        'dapodik_bangunan',
    ];

    foreach ($publicTables as $table) {
        $this->assertTrue(Schema::hasTable($table), "Table {$table} not found after migrate");
    }
});

it('runs man_akses schema migrations', function () {
    $this->artisan('migrate')->assertExitCode(0);

    $tables = [
        'dapodik_man_akses_aplikasi',
        'dapodik_man_akses_pengguna',
        'dapodik_man_akses_peran',
        'dapodik_man_akses_menu',
        'dapodik_man_akses_menu_role',
        'dapodik_man_akses_role_pengguna',
        'dapodik_man_akses_log_otentikasi',
        'dapodik_man_akses_log_otorisasi',
    ];

    foreach ($tables as $table) {
        $this->assertTrue(Schema::hasTable($table), "Table {$table} not found");
    }
});

it('runs pustaka schema migrations', function () {
    $this->artisan('migrate')->assertExitCode(0);

    $tables = [
        'dapodik_pustaka_biblio',
        'dapodik_pustaka_classifications',
        'dapodik_pustaka_daftar_author',
        'dapodik_pustaka_frequency',
        'dapodik_pustaka_gmd',
        'dapodik_pustaka_mapel_biblio',
        'dapodik_pustaka_publisher',
        'dapodik_pustaka_tingkat_biblio',
    ];

    foreach ($tables as $table) {
        $this->assertTrue(Schema::hasTable($table), "Table {$table} not found");
    }
});

it('runs nilai schema migrations', function () {
    $this->artisan('migrate')->assertExitCode(0);

    $tables = [
        'dapodik_nilai_matev_rapor',
        'dapodik_nilai_nilai_ekskul',
        'dapodik_nilai_nilai_rapor',
        'dapodik_nilai_nilai_smt',
        'dapodik_nilai_un',
    ];

    foreach ($tables as $table) {
        $this->assertTrue(Schema::hasTable($table), "Table {$table} not found");
    }
});

it('runs audit and blob schema migrations', function () {
    $this->artisan('migrate')->assertExitCode(0);

    $this->assertTrue(Schema::hasTable('dapodik_audit_logged_actions'));
    $this->assertTrue(Schema::hasTable('dapodik_blob_large_object'));
});

it('can rollback all schema migrations', function () {
    $this->artisan('migrate')->assertExitCode(0);
    $this->assertTrue(Schema::hasTable('dapodik_ref_agama'));

    $this->artisan('migrate:rollback')->assertExitCode(0);
    $this->assertFalse(Schema::hasTable('dapodik_ref_agama'));
});

it('handles migrate fresh for all schemas', function () {
    $this->artisan('migrate')->assertExitCode(0);
    $this->artisan('migrate:fresh')->assertExitCode(0);

    $checkTables = [
        'dapodik_ref_agama',
        'dapodik_sekolah',
        'dapodik_man_akses_pengguna',
        'dapodik_pustaka_biblio',
        'dapodik_nilai_matev_rapor',
        'dapodik_audit_logged_actions',
        'dapodik_blob_large_object',
    ];

    foreach ($checkTables as $table) {
        $this->assertTrue(Schema::hasTable($table), "Table {$table} missing after migrate:fresh");
    }
});
