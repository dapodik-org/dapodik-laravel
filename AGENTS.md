# AGENTS.md

## Branch strategy

| Branch | Laravel | PHP       | CS Fixer | Testing | Testbench            |
|--------|---------|-----------|----------|---------|----------------------|
| `main` | 9–13    | >=8.1     | Pint     | Pest    | ^8.0 or ^9.0 or ^10.0 or ^11.0 |
| `1.x`  | 7, 8    | >=7.2.5   | php-cs-fixer | PHPUnit | ^5.0 \|\| ^6.0  |

- **`main`** = Laravel 9–13 (current)
- **`1.x`** = Laravel 7|8 (legacy)
- Saat support Laravel 14+, buat branch baru
- Split CI: `.github/workflows/split.yml` — push ke `main` atau `1.x` atau tags
- Push ke `main` → split ke sub-repo branch `main`
- Push ke `1.x` → split ke sub-repo branch `1.x`
- Tag `v2.*` → tag `v2.*` di sub-repo (main)
- Tag `v1.*` → tag `v1.*` di sub-repo (1.x)
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

- Eloquent: orchestra/testbench ^7.0 || ^8.0 || ^9.0 + Pest ^2.0, SQLite in-memory
- API: orchestra/testbench ^7.0 || ^8.0 || ^9.0 + Pest ^2.0, no database
- CI matrix: `.github/workflows/tests.yml` — PHP 8.2/8.3/8.4 × Laravel 10–13 × Eloquent/API

## Lint & static analysis

```bash
composer lint             # pint --test
composer cs-fix           # pint
composer analyse          # phpstan level 0
composer check            # lint → analyse → test
```

Root configs: `pint.json` and `phpstan.neon.dist`.

## PHP & Framework constraints

- PHP >=8.1: typed properties, arrow functions, native enums, union types, match
- Laravel 9–13 (illuminate/* ^9.0 || ^10.0 || ^11.0 || ^12.0 || ^13.0)
- Enums are backed string enums
- Use `spatie/laravel-package-tools` for ServiceProviders (if applicable)
- `class_exists()` can detect traits — use `class_exists()`

## Key subpackage conventions (src/laravel/Eloquent/)

- Namespace: `Dapodik\Laravel\Eloquent`
- Facade accessor: `dapodik.eloquent.laravel`
- Models: `$incrementing = false`, string UUID PKs
- SoftDeletes: `CREATED_AT = 'create_date'`, `UPDATED_AT = 'last_update'`, `DELETED_AT = 'expired_date'`
- Table naming: `{prefix}_{subdir}_{table}_{suffix}` derived from namespace
- Adding a model? Always add corresponding migration + register in `EloquentServiceProvider::MIGRATION_MODEL_MAP`
- Custom `tests/bootstrap.php` suppresses `E_DEPRECATED` (needed on PHP 8+)

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

