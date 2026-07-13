# Dapodik Laravel — Monorepo

[![Tests](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml/badge.svg)](https://github.com/dapodik-org/dapodik-laravel/actions/workflows/tests.yml)
[![Laravel](https://img.shields.io/badge/Laravel-7%20|%208-red?style=flat-square&logo=laravel)](https://laravel.com)

Monorepo untuk paket-paket Laravel Dapodik.

## Paket

| Paket | Direktori | Split ke |
|-------|-----------|----------|
| Eloquent | `src/laravel/Eloquent/` | [dapodik-org/dapodik-laravel-eloquent](https://github.com/dapodik-org/dapodik-laravel-eloquent) |
| API | `src/laravel/API/` | [dapodik-org/dapodik-laravel-api](https://github.com/dapodik-org/dapodik-laravel-api) |

## Pengembangan

```bash
# Install dependensi
composer install

# Test semua paket
composer test

# Lint & static analysis
composer lint
composer analyse
```

## Lisensi

MIT

## Peringatan

Dalam penggunaan library pihak ketiga Aplikasi Dapodik berarti Anda secara sadar memberikan data individu setiap entitas Dapodik kepada pihak ketiga. Segala bentuk penyalahgunaan dapat diancam dengan hukuman pidana sesuai dengan UU Perlindungan Data Pribadi No 27 Tahun 2022 Pasal 67.
Mohon anda benar-benar telah paham dan yakin akan hal tersebut.
