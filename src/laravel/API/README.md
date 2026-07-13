> **BACA SAJA** — File ini dikelola dari repositori utama [`dapodik-org/dapodik-laravel`](https://github.com/dapodik-org/dapodik-laravel). Jangan edit langsung di sini.

# Dapodik API Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dapodik-org/dapodik-laravel-api.svg?style=flat-square)](https://packagist.org/packages/dapodik-org/dapodik-laravel-api)
[![Laravel](https://img.shields.io/badge/Laravel-7%20|%208-red?style=flat-square&logo=laravel)](https://laravel.com)
[![GitHub Tests Action Status](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/dapodik-org/dapodik-laravel-api.svg?style=flat-square)](https://packagist.org/packages/dapodik-org/dapodik-laravel-api)

**Klien Dapodik API untuk Laravel.**  
Library ini memudahkan koneksi dan interaksi dengan REST API dan WebService Aplikasi Dapodik langsung dari Laravel.

## Persyaratan

- PHP >=7.2.5
- Laravel 7 || 8
- [Aplikasi Dapodik](https://dapo.dikdasmen.go.id/unduhan) sudah berjalan di server atau komputer Anda.

## Instalasi

```bash
composer require dapodik-org/dapodik-laravel-api
```

### Publikasi berkas konfigurasi

```bash
php artisan vendor:publish --tag="dapodik-api-config"
```

## Konfigurasi

Atur koneksi di file `.env`:

```dotenv
# REST (autentikasi)
DAPODIK_API_CONNECTION=authentication
DAPODIK_API_HOST=http://localhost:5774
DAPODIK_API_USERNAME=
DAPODIK_API_PASSWORD=
DAPODIK_API_KODE_REGISTRASI=

# WebService (otorisasi)
#DAPODIK_API_CONNECTION=authorization
#DAPODIK_API_HOST=http://localhost:5774
DAPODIK_API_NPSN=
DAPODIK_API_TOKEN=
```

### Driver pendukung

| Driver        | Metode autentikasi  | Cocok untuk                          |
|---------------|---------------------|--------------------------------------|
| `authentication` | username/password/kode_registrasi | REST API — akses penuh fitur Dapodik |
| `authorization`  | NPSN/token          | WebService API — akses terbatas      |

## Penggunaan

Contoh di `routes/web.php`:

```php
use Dapodik\Laravel\API\Facades\API;
use Illuminate\Support\Facades\Route;

// REST — ambil data peserta didik
Route::get('/dapodik-api', function () {
    dd(
        API::query('PesertaDidik', [
            'pd_module' => 'pdterdaftar',
            'limit' => 20,
        ])->toArray()
    );
});

// WebService — ambil data sekolah lewat otorisasi
Route::get('/dapodik-api', function () {
    dd(
        API::connection('authorization')
            ->query('getSekolah')->toArray(),
        API::connection('authorization')
            ->getSekolah()->toCollection(),
        API::connection('authorization')
            ->getSekolah()->toJson(),
    );
});
```

Jalankan server pengembangan:

```bash
php artisan serve
```

Buka `http://localhost:8000/dapodik-api` di browser.

## Pengujian

```bash
composer test:api
```

## Lisensi

MIT License. Lihat [LICENSE](LICENSE.md) untuk detail.

## Peringatan

Dengan menggunakan library ini, data individu setiap entitas Dapodik akan dikirim ke pihak ketiga sesuai konfigurasi yang Anda atur. Penyalahgunaan data diancam dengan UU Perlindungan Data Pribadi No 27 Tahun 2022 Pasal 67.

Pastikan Anda memahami dan menyetujui risiko sebelum menggunakan library ini.
