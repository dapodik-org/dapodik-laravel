# Contributing

## Setup

```bash
composer install
```

## Testing

```bash
# Semua paket
composer test

# Per paket
composer test:eloquent
composer test:api
```

## Lint & Static Analysis

```bash
composer lint
composer analyse
composer check    # lint → analyse → test
```

## Branch Strategy

| Branch | Laravel | PHP       |
|--------|---------|-----------|
| `main` | 7, 8    | >=7.2.5   |

- `main` untuk Laravel 7|8. Buat branch baru saat menambahkan support Laravel 9+.

## Menambahkan Model (Eloquent)

1. Buat class model di `src/laravel/Eloquent/Models/{Schema}/`
2. Buat migration di `src/laravel/Eloquent/database/migrations/dapodik/`
3. Daftarkan mapping model → migration di `EloquentServiceProvider::MIGRATION_MODEL_MAP`
4. Jalankan `composer test:eloquent`

## Menambahkan Endpoint API

1. Tambahkan method di `src/laravel/API/Connection.php`
2. Tambahkan test di `tests/API/`
3. Jalankan `composer test:api`

## Commit Convention

- Gunakan bahasa Indonesia atau Inggris
- Awali dengan kata kerja (contoh: `fix: ...`, `add: ...`, `update: ...`)
- Satu commit per perubahan logis

## Pull Request

- Pastikan semua test lulus: `composer check`
- Targetkan ke branch `main`
- Screenshot/test output sangat disarankan