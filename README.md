# Dapodik Laravel — Repositori Utama

[![Tests](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml)
[![Laravel](https://img.shields.io/badge/Laravel-7%20|%208-red?style=flat-square&logo=laravel)](https://laravel.com)

Monorepo untuk paket-paket Laravel Dapodik.

## Paket

| Paket | Direktori | Tujuan |
|-------|-----------|--------|
| Eloquent | `src/laravel/Eloquent/` | [dapodik-org/dapodik-laravel-eloquent](https://github.com/dapodik-org/dapodik-laravel-eloquent) |
| API | `src/laravel/API/` | [dapodik-org/dapodik-laravel-api](https://github.com/dapodik-org/dapodik-laravel-api) |

## Pengembangan

```bash
# Pasang dependensi
composer install

# Uji semua paket
composer test

# Lint & static analysis
composer lint
composer analyse
```

## Lisensi

MIT

## Peringatan

Dengan menggunakan library ini, data individu setiap entitas Dapodik akan dikirim ke pihak ketiga sesuai konfigurasi yang Anda atur. Penyalahgunaan data diancam dengan UU Perlindungan Data Pribadi No 27 Tahun 2022 Pasal 67.

Pastikan Anda memahami dan menyetujui risiko sebelum menggunakan library ini.
