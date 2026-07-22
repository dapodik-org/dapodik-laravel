> **BACA SAJA** — File ini dikelola dari repositori utama [`dapodik-org/dapodik-laravel`](https://github.com/dapodik-org/dapodik-laravel). Jangan edit langsung di sini.

# Dapodik Eloquent Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dapodik-org/dapodik-laravel-eloquent.svg?style=flat-square)](https://packagist.org/packages/dapodik-org/dapodik-laravel-eloquent)
[![Laravel](https://img.shields.io/badge/Laravel-9%20–%2013-red?style=flat-square&logo=laravel)](https://laravel.com)
[![GitHub Tests Action Status](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml)
[![GitHub Code Style Action Status](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/fix-php-code-style-issues.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/dapodik-org/dapodik-laravel-eloquent.svg?style=flat-square)](https://packagist.org/packages/dapodik-org/dapodik-laravel-eloquent)

**Model Eloquent Dapodik untuk Laravel.**  
Paket ini menyediakan model, migrasi, dan command untuk menerbitkan model Dapodik langsung ke aplikasi Laravel Anda.

## Persyaratan

- PHP >=8.1
- Laravel 9 – 13
- [Aplikasi Dapodik](https://dapo.dikdasmen.go.id/unduhan) sudah terinstal dan database sudah tersedia

## Instalasi

```bash
composer require dapodik-org/dapodik-laravel-eloquent
```

### Dukungan database

| Driver | Status |
|--------|--------|
| MySQL | ✅ Didukung |
| MariaDB | ✅ Didukung |
| PostgreSQL | ✅ Didukung |
| SQL Server | ✅ Didukung |
| SQLite | ✅ Didukung |

## Publikasi migrasi

```bash
php artisan vendor:publish --tag="dapodik-eloquent-migrations"
php artisan migrate
```

### Publikasi migration via command

Publikasikan seluruh migration ke direktori `database/migrations/`:

```bash
php artisan dapodik:eloquent-publish-migration
```

Untuk satu migration saja, gunakan key migration seperti `agama`:

```bash
php artisan dapodik:eloquent-publish-migration agama
```

Gunakan `--force` untuk menimpa file yang sudah ada:

```bash
php artisan dapodik:eloquent-publish-migration --force
```

## Publikasi konfigurasi

```bash
php artisan vendor:publish --tag="dapodik-eloquent-config"
```

## Publikasi model

Publikasikan seluruh model ke aplikasi Anda:

```bash
php artisan dapodik:eloquent-publish
```

Untuk satu model saja, gunakan key model seperti `agama`:

```bash
php artisan dapodik:eloquent-publish agama
```

Perintah ini menyalin folder `Models` dari package ke `app/Models/Dapodik` dan mengubah namespace menjadi `App\Models\Dapodik\...`.

## Pembuatan database

Buat database Dapodik jika belum ada:

```bash
php artisan dapodik:eloquent-db-create
```

Perintah ini membaca konfigurasi koneksi dari `DAPODIK_ELOQUENT_CONNECTION` (atau koneksi default) dan membuat database bila belum tersedia.

| Driver | Perilaku |
|--------|----------|
| MySQL / MariaDB | `CREATE DATABASE IF NOT EXISTS` |
| PostgreSQL | Cek `pg_database` lalu `CREATE DATABASE` |
| SQLite | Touch file database |
| SQL Server | Cek `sys.databases` lalu `CREATE DATABASE` |

Gunakan opsi `--connection` untuk koneksi tertentu:

```bash
php artisan dapodik:eloquent-db-create --connection=dapodik
```

Gunakan opsi `--database` untuk menentukan nama database:

```bash
php artisan dapodik:eloquent-db-create --database=dapodik_ref
```

### Koneksi terpisah (split connection)

Saat `split_connection` diaktifkan, perintah ini otomatis membuat database/schema untuk setiap subdirektori model:

| Subdirektori | MySQL / MariaDB / SQL Server | PostgreSQL | SQLite |
|-------------|-------------------------------|------------|--------|
| `ref`       | `{database}_ref`              | Schema `ref` | `{base}_ref.sqlite` |
| `public`    | `{database}_public`           | Schema `public` | `{base}_public.sqlite` |
| `man_akses` | `{database}_man_akses`        | Schema `man_akses` | `{base}_man_akses.sqlite` |
| `pustaka`   | `{database}_pustaka`          | Schema `pustaka` | `{base}_pustaka.sqlite` |
| `nilai`     | `{database}_nilai`            | Schema `nilai` | `{base}_nilai.sqlite` |
| `audit`     | `{database}_audit`            | Schema `audit` | `{base}_audit.sqlite` |
| `blob`      | `{database}_blob`             | Schema `blob` | `{base}_blob.sqlite` |

## Konfigurasi

```php
return [
    /*
     * Prefix tabel.
     */
    'prefix' => env('DAPODIK_ELOQUENT_PREFIX', 'dapodik'),

    /*
     * Suffix tabel.
     */
    'suffix' => env('DAPODIK_ELOQUENT_SUFFIX', null),

    /*
     * Nama koneksi database Laravel (dari config/database.php).
     * Biarkan null untuk menggunakan koneksi default.
     */
    'connection' => env('DAPODIK_ELOQUENT_CONNECTION', null),

    /*
     * Aktifkan split connection per subdirektori model.
     * Jika true, setiap subdirektori (ref, public, man_akses, dll.)
     * akan menggunakan koneksi terpisah: {connection}_{folder}.
     */
    'split_connection' => env('DAPODIK_ELOQUENT_SPLIT_CONNECTION', false),

    /*
     * Lewati drop tabel saat migrate:fresh.
     * Jika true, tabel dapodik tidak akan dihapus
     * saat php artisan migrate:fresh.
     */
    'skip_fresh' => env('DAPODIK_ELOQUENT_SKIP_FRESH', false),

    /*
     * Exclude tabel dari migration.
     * Lihat penjelasan di bawah untuk detailnya.
     */
    'exclude_tables' => [],
];
```

### Pengecualian tabel

Gunakan `exclude_tables` untuk mencegah tabel tertentu dibuat saat migrasi awal. File migration `create` yang sesuai akan **dihapus permanen** dari filesystem sebelum migrasi dijalankan.

> **Catatan:** Hanya berlaku untuk migration di folder `database/migrations/dapodik/`.

Pencocokan dilakukan terhadap:
- Nama file migration (tanpa timestamp): `create_dapodik_sync_log_table`
- Key tabel (snake_case) dari mapping internal: `sync_log`
- FQCN model class: `\Dapodik\Laravel\Eloquent\Models\SyncLog::class`

Regex diapit `/` dan dicocokkan terhadap ketiga target di atas.

```php
'exclude_tables' => [
    'create_dapodik_sync_log_table',            // nama file migration
    'sync_primer',                              // key tabel
    \Dapodik\Laravel\Eloquent\Models\SyncLog::class,
    '/^create_dapodik_sync_.+$/',               // regex nama file
    '/^create_dapodik_vld_.+$/',                // regex nama file
    '/^log_/',                                  // regex key tabel diawali log_
    '/_log_/',                                  // regex key tabel mengandung _log_
],
```

> Jika tabel sudah pernah di-exclude lalu ingin dikembalikan:
> ```bash
> php artisan vendor:publish --tag=dapodik-eloquent-migrations --force
> ```

### Skip fresh

Saat `skip_fresh` diaktifkan (`true`), tabel dapodik **tidak akan dihapus** saat `php artisan migrate:fresh`. Berguna menjaga data Dapodik tetap aman sementara tabel lain di-reset.

```php
'skip_fresh' => env('DAPODIK_ELOQUENT_SKIP_FRESH', false),
```

Atur lewat `.env`:
```
DAPODIK_ELOQUENT_SKIP_FRESH=true
```

### Koneksi terpisah (split connection)

Saat `split_connection` diaktifkan, setiap subdirektori model menggunakan koneksi database terpisah:

| Subdirektori | Nama koneksi (jika connection = `dapodik`) |
|-------------|------------------------------------------|
| `ref`       | `dapodik_ref` |
| `public`    | `dapodik_public` |
| `man_akses` | `dapodik_man_akses` |
| `pustaka`   | `dapodik_pustaka` |
| `nilai`     | `dapodik_nilai` |
| `audit`     | `dapodik_audit` |
| `blob`      | `dapodik_blob` |

Suffix database (MySQL, MariaDB, SQL Server):
```
dapodik_ref, dapodik_public, ...
```

Search path (PostgreSQL):
```
ref, public, man_akses, ...
```

File database terpisah (SQLite):
```
database/dapodik_ref.sqlite, database/dapodik_public.sqlite, ...
```

## Pengujian

```bash
composer test:eloquent
```

## Kontribusi

Lihat [CONTRIBUTING.md](../../CONTRIBUTING.md) untuk detail.

## Keamanan

Laporkan celah keamanan melalui [kebijakan keamanan](../../security/policy).

## Kredit

- [Dapodik Org](https://github.com/dapodik-org)
- [Ade Reksi Susanto](https://github.com/adereksisusanto)
- [Semua kontributor](../../contributors)

## Lisensi

MIT License. Lihat [LICENSE](LICENSE.md) untuk detail.

## Peringatan

Dengan menggunakan library ini, data individu setiap entitas Dapodik akan dikirim ke pihak ketiga sesuai konfigurasi yang Anda atur. Penyalahgunaan data diancam dengan UU Perlindungan Data Pribadi No 27 Tahun 2022 Pasal 67.

Pastikan Anda memahami dan menyetujui risiko sebelum menggunakan library ini.
