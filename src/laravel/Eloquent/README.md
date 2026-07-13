> **READ ONLY** — File ini dikelola dari monorepo [`dapodik-org/dapodik-laravel`](https://github.com/dapodik-org/dapodik-laravel). Jangan edit langsung di sini.

# Dapodik Eloquent for Laravel Framework

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dapodik-org/dapodik-laravel-eloquent.svg?style=flat-square)](https://packagist.org/packages/dapodik-org/dapodik-laravel-eloquent)
[![Laravel](https://img.shields.io/badge/Laravel-7%20|%208-red?style=flat-square&logo=laravel)](https://laravel.com)
[![GitHub Tests Action Status](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml)
[![GitHub Code Style Action Status](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/fix-php-code-style-issues.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/dapodik-org/dapodik-laravel-eloquent.svg?style=flat-square)](https://packagist.org/packages/dapodik-org/dapodik-laravel-eloquent)

Paket ini menyediakan model Eloquent Dapodik yang siap digunakan di aplikasi Laravel Anda. Termasuk konfigurasi model, migrasi, dan command untuk menerbitkan model ke dalam folder aplikasi.

## Instalasi

Install package lewat Composer:

```bash
composer require dapodik-org/dapodik-laravel-eloquent
```

### Dukungan Database

| Driver | Versi |
|--------|-------|
| MySQL | ✅ Didukung |
| MariaDB | ✅ Didukung |
| PostgreSQL | ✅ Didukung |
| SQL Server | ✅ Didukung |
| SQLite | ✅ Didukung |

## Publikasi Migrasi

```bash
php artisan vendor:publish --tag="dapodik-eloquent-migrations"
php artisan migrate
```

## Publikasi Konfigurasi

```bash
php artisan vendor:publish --tag="dapodik-eloquent-config"
```

## Publikasi Model

Publish seluruh model package ke aplikasi Anda:

```bash
php artisan dapodik:eloquent-publish
```

Untuk publish satu model saja, gunakan nama model (key) seperti `agama`:

```bash
php artisan dapodik:eloquent-publish agama
```

Command ini akan menyalin seluruh folder `Models` dari package ke `app/Models/Dapodik`, dan mengubah namespace model menjadi `App\Models\Dapodik\...`.

## Pembuatan Database

Buat database Dapodik jika belum ada:

```bash
php artisan dapodik:eloquent-db-create
```

Command ini membaca konfigurasi koneksi dari `DAPODIK_ELOQUENT_CONNECTION` (atau koneksi default Laravel) dan membuat database jika belum tersedia.

Mendukung semua driver:

| Driver | Perilaku |
|--------|----------|
| MySQL / MariaDB | `CREATE DATABASE IF NOT EXISTS` |
| PostgreSQL | Cek `pg_database` lalu `CREATE DATABASE` |
| SQLite | Touch file database |
| SQL Server | Cek `sys.databases` lalu `CREATE DATABASE` |

Gunakan opsi `--connection` untuk menentukan koneksi tertentu:

```bash
php artisan dapodik:eloquent-db-create --connection=dapodik
```

Gunakan opsi `--database` untuk menentukan nama database yang akan dibuat:

```bash
php artisan dapodik:eloquent-db-create --database=dapodik_ref
```

### Split Connection

Saat `split_connection` diaktifkan, command ini otomatis membuat database/schema untuk setiap subdirektori model:

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

Berikut adalah isi file konfigurasi:

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

### Exclude Tables

Gunakan `exclude_tables` untuk mencegah tabel tertentu dibuat saat migrasi awal. File migration `create` yang sesuai akan **dihapus permanen dari filesystem** sebelum migrasi dijalankan, sehingga tidak ada entry di tabel migrations.

> **Catatan:** Hanya berlaku untuk migration di folder `database/migrations/dapodik/`. Migration di folder lain tidak terpengaruh.

Pencocokan dilakukan terhadap:
- Nama file migration (tanpa timestamp): `create_dapodik_sync_log_table`
- Key tabel (snake_case) dari mapping internal: `sync_log`
- FQCN model class: `\Dapodik\Laravel\Eloquent\Models\SyncLog::class`

Regex diapit `/` dan dicocokkan terhadap ketiga target di atas.

```php
'exclude_tables' => [
    'create_dapodik_sync_log_table',            // nama file migration
    'sync_primer',                              // key tabel (snake_case)
\Dapodik\Laravel\Eloquent\Models\SyncLog::class,            // FQCN model
    '/^create_dapodik_sync_.+$/',               // regex: nama file diawali create_dapodik_sync_
    '/^create_dapodik_vld_.+$/',                // regex: nama file diawali create_dapodik_vld_
    '/^log_/',                                  // regex: key tabel diawali log_ (log_otentikasi, dll)
    '/_log_/',                                  // regex: key tabel mengandung _log_ (sync_log, dll)
],
```

> Jika sebelumnya tabel sudah pernah di-exclude lalu ingin dikembalikan, jalankan:
> ```bash
> php artisan vendor:publish --tag=dapodik-eloquent-migrations --force
> ```

### Skip Fresh

Saat `skip_fresh` diaktifkan (true), tabel dapodik **tidak akan dihapus** saat menjalankan `php artisan migrate:fresh`. Berguna ketika ingin menjaga data dapodik tetap aman sementara tabel lain di-reset.

```php
'skip_fresh' => env('DAPODIK_ELOQUENT_SKIP_FRESH', false),
```

Atur melalui file `.env`:
```
DAPODIK_ELOQUENT_SKIP_FRESH=true
```

### Split Connection

Saat `split_connection` diaktifkan, setiap subdirektori model (mis. `ref`, `public`, `man_akses`) akan menggunakan koneksi database terpisah secara otomatis:

| Subdirektori | Nama Koneksi (jika connection = `dapodik`) |
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

## Testing

Testing dilakukan dari monorepo root:

```bash
cd ..
composer test:eloquent
```



## Contributing

Please see [CONTRIBUTING.md](../../CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Dapodik Org](https://github.com/dapodik-org)
- [Ade Reksi Susanto](https://github.com/adereksisusanto)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). See [LICENSE](LICENSE.md) for more information.

## Peringatan

Dalam penggunaan library pihak ketiga Aplikasi Dapodik berarti Anda secara sadar memberikan data individu setiap entitas Dapodik kepada pihak ketiga. Segala bentuk penyalahgunaan dapat diancam dengan hukuman pidana sesuai dengan UU Perlindungan Data Pribadi No 27 Tahun 2022 Pasal 67.
Mohon anda benar-benar telah paham dan yakin akan hal tersebut.
