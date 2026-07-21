# AGENTS.md

## Branch strategy

| Branch | Laravel | PHP       | CS Fixer       | Testing | Testbench   |
|--------|---------|-----------|----------------|---------|-------------|
| `1.x`  | 7, 8    | >=7.2.5   | php-cs-fixer   | PHPUnit | ^5.0 || ^6.0 |
| `main` | 9–13    | >=8.1     | Pint           | Pest    | ^7.0–^11.0  |

- **`1.x`** = Laravel 7|8 (current, legacy)
- **`main`** = Laravel 9–13 (2.x, divergen)
- Split CI: `.github/workflows/split.yml` — push ke `1.x`, `main`, atau tags
- Push ke `1.x` → split ke sub-repo branch `1.x`
- Push ke `main` → split ke sub-repo branch `main`
- Tag `v1.*` → tag `v1.*` di sub-repo (1.x)
- Tag `v2.*` → tag `v2.*` di sub-repo (main)
- `SPLIT_TOKEN` secret: Personal Access Token with `repo` scope

## Monorepo structure

src/laravel/
Eloquent/    → split to dapodik-org/dapodik-laravel-eloquent
API/         → split to dapodik-org/dapodik-laravel-api

- `composer.json` has `replace` for `dapodik-org/dapodik-laravel-eloquent` and `dapodik-org/dapodik-laravel-api`

## Testing

```bash
composer test
```

- Eloquent: orchestra/testbench ^5.0 || ^6.0 + phpunit ^8.0||^9.0, SQLite in-memory
- API: orchestra/testbench ^5.0 || ^6.0 + phpunit ^8.0||^9.0, no database
- CI matrix: `.github/workflows/tests.yml` — PHP 7.2/7.4/8.0 × Eloquent/API

## Lint & static analysis

```bash
composer lint             # php-cs-fixer --dry-run
composer cs-fix           # php-cs-fixer auto-fix
composer analyse          # phpstan level 0
composer check            # lint → analyse → test
```

Root configs: `.php-cs-fixer.dist.php` and `phpstan.neon.dist`.

## PHP & Framework constraints

- PHP >=7.2.5: no typed properties, no arrow functions, no native enums, no union types, no match
- Laravel 7|8 (illuminate/* ^7.0 || ^8.0)
- `Public` is reserved in PHP 7.2 — use namespace `Publik` instead
- Enums are class constants (`const LakiLaki = 'L'`) with static `label()`
- No `spatie/laravel-package-tools`
- `class_exists()` cannot detect traits — use `trait_exists()`

## Key subpackage conventions (src/laravel/Eloquent/)

- Namespace: `Dapodik\Laravel\Eloquent`
- Facade accessor: `dapodik.eloquent.laravel`
- Models: `$incrementing = false`, string UUID PKs
- SoftDeletes: `CREATED_AT = 'create_date'`, `UPDATED_AT = 'last_update'`, `DELETED_AT = 'expired_date'`
- Table naming: `{prefix}_{subdir}_{table}_{suffix}` derived from namespace
- Adding a model? Always add corresponding migration + register in `EloquentServiceProvider::MIGRATION_MODEL_MAP`
- Custom `tests/bootstrap.php` suppresses `E_DEPRECATED` (needed on PHP 8+)

## Git rules

- Jangan pernah commit atau push tanpa izin eksplisit dari user
- Selalu tanya sebelum menjalankan git commit, push, atau operasi yang mengubah remote
- Perubahan hanya boleh dilakukan setelah user menyetujui

## API subpackage (src/laravel/API/)

- Namespace: `Dapodik\Laravel\API`
- ServiceProvider: `APIServiceProvider` extends `\Illuminate\Support\ServiceProvider`
- Facade: `API` (accessor: `dapodik.api.laravel`)
- Config: `config/dapodik-api.php`
- Uses `guzzlehttp/guzzle` for HTTP client
- `APIManager` manages connections, delegates to `Connection`
- `Connection` wraps Guzzle client, supports two drivers:
  - `rest` — username/password/kode_registrasi authentication (REST API)
  - `webservice` — NPSN/token authorization (WebService API)
- `Response` wraps PSR-7 response, methods: `toArray()`, `toCollection()`, `toJson()`

---

