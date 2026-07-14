<?php

namespace Dapodik\Laravel\Eloquent\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PDO;

class DapodikEloquentDatabaseCreateCommand extends Command
{
    const SUCCESS = 0;

    const FAILURE = 1;

    protected $signature = 'dapodik:eloquent-db-create
        {--connection= : The database connection name to use}
        {--database= : The database name to create}';

    protected $description = 'Create the Dapodik database(s) if they do not exist';

    public function handle()
    {
        $connectionName = $this->option('connection') ?: Config::get('dapodik-eloquent.connection', Config::get('database.default'));
        $connectionConfig = Config::get("database.connections.{$connectionName}");

        if ($connectionConfig === null) {
            $this->error("Database connection '{$connectionName}' is not configured in config/database.php.");

            return self::FAILURE;
        }

        $driver = $connectionConfig['driver'];
        $database = $connectionConfig['database'] ?? null;

        if ($database === null) {
            $this->error('No database name found in connection config.');

            return self::FAILURE;
        }

        $split = Config::get('dapodik-eloquent.split_connection', false);

        if ($split) {
            return $this->handleSplitConnection($connectionConfig, $driver, $database);
        }

        $customDatabase = $this->option('database');

        return $this->createDatabase($driver, $connectionConfig, $customDatabase ?? $database);
    }

    protected function handleSplitConnection(array $config, $driver, $database)
    {
        $paths = File::directories(__DIR__.'/../Models');
        $folders = array_map(function ($path) {
            return Str::snake(basename($path));
        }, $paths);

        $exitCode = self::SUCCESS;

        switch ($driver) {
            case 'mysql':
            case 'mariadb':
                if ($this->createMysqlDatabase($config, $database) === self::FAILURE) {
                    return self::FAILURE;
                }
                foreach ($folders as $folder) {
                    $dbName = "{$database}_{$folder}";
                    if ($this->createMysqlDatabase($config, $dbName) === self::FAILURE) {
                        $exitCode = self::FAILURE;
                    }
                }
                break;

            case 'pgsql':
                if ($this->createPostgresDatabase($config, $database) === self::FAILURE) {
                    return self::FAILURE;
                }
                foreach ($folders as $folder) {
                    if ($this->createPostgresSchema($config, $database, $folder) === self::FAILURE) {
                        $exitCode = self::FAILURE;
                    }
                }
                break;

            case 'sqlsrv':
                if ($this->createSqlSrvDatabase($config, $database) === self::FAILURE) {
                    return self::FAILURE;
                }
                foreach ($folders as $folder) {
                    $dbName = "{$database}_{$folder}";
                    if ($this->createSqlSrvDatabase($config, $dbName) === self::FAILURE) {
                        $exitCode = self::FAILURE;
                    }
                }
                break;

            case 'sqlite':
                $databaseDir = dirname($database);
                $pathInfo = pathinfo($database);
                $baseName = $pathInfo['filename'];
                $ext = $pathInfo['extension'] ?? 'sqlite';

                if ($this->createSqliteDatabase($config, $database) === self::FAILURE) {
                    return self::FAILURE;
                }
                foreach ($folders as $folder) {
                    $dbPath = ($databaseDir ? $databaseDir.DIRECTORY_SEPARATOR : '')."{$baseName}_{$folder}.{$ext}";
                    if ($this->createSqliteDatabase($config, $dbPath, $folder) === self::FAILURE) {
                        $exitCode = self::FAILURE;
                    }
                }
                break;
        }

        return $exitCode;
    }

    protected function createDatabase($driver, array $config, $database)
    {
        $customDatabase = $this->option('database');

        switch ($driver) {
            case 'mysql':
            case 'mariadb':
                return $this->createMysqlDatabase($config, $customDatabase ?? $database);
            case 'pgsql':
                return $this->createPostgresDatabase($config, $customDatabase ?? $database);
            case 'sqlite':
                return $this->createSqliteDatabase($config, $customDatabase ?? $database);
            case 'sqlsrv':
                return $this->createSqlSrvDatabase($config, $customDatabase ?? $database);
            default:
                throw new \RuntimeException("Unsupported database driver: {$driver}");
        }
    }

    protected function createMysqlDatabase(array $config, $database)
    {
        $config['database'] = null;
        $dsn = $this->buildMysqlDsn($config);

        try {
            $pdo = new PDO($dsn, $config['username'] ?? null, $config['password'] ?? null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            $charset = $config['charset'] ?? 'utf8mb4';
            $collation = $config['collation'] ?? 'utf8mb4_unicode_ci';

            $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET {$charset} COLLATE {$collation}");

            $this->info("Database '{$database}' created or already exists.");

            return self::SUCCESS;
        } catch (\PDOException $e) {
            $this->error("Failed to create database '{$database}': ".$e->getMessage());

            return self::FAILURE;
        }
    }

    protected function createPostgresDatabase(array $config, $database)
    {
        $config['database'] = 'postgres';
        $dsn = $this->buildPostgresDsn($config);

        try {
            $pdo = new PDO($dsn, $config['username'] ?? null, $config['password'] ?? null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            $result = $pdo->query('SELECT 1 FROM pg_database WHERE datname = '.$pdo->quote($database));

            if ($result->fetchColumn()) {
                $this->info("Database '{$database}' already exists.");

                return self::SUCCESS;
            }

            $pdo->exec('CREATE DATABASE '.$pdo->quote($database));

            $this->info("Database '{$database}' created.");

            return self::SUCCESS;
        } catch (\PDOException $e) {
            $this->error("Failed to create database '{$database}': ".$e->getMessage());

            return self::FAILURE;
        }
    }

    protected function createPostgresSchema(array $config, $database, $schema)
    {
        $config['database'] = $database;
        $dsn = $this->buildPostgresDsn($config);

        try {
            $pdo = new PDO($dsn, $config['username'] ?? null, $config['password'] ?? null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            $pdo->exec('CREATE SCHEMA IF NOT EXISTS '.$pdo->quote($schema));

            $this->info("Schema '{$schema}' in database '{$database}' created or already exists.");

            return self::SUCCESS;
        } catch (\PDOException $e) {
            $this->error("Failed to create schema '{$schema}' in database '{$database}': ".$e->getMessage());

            return self::FAILURE;
        }
    }

    protected function createSqliteDatabase(array $config, $database, $label = null)
    {
        $databasePath = $database;

        if (DIRECTORY_SEPARATOR === '/') {
            $isAbsolute = strpos($databasePath, '/') === 0;
        } else {
            $isAbsolute = (bool) preg_match('/^[A-Za-z]:\\\\/', $databasePath);
        }

        if (! $isAbsolute) {
            $databasePath = database_path($databasePath);
        }

        if (file_exists($databasePath)) {
            $display = $label ? "SQLite database '{$label}' ({$databasePath})" : "SQLite database '{$databasePath}'";
            $this->info("{$display} already exists.");

            return self::SUCCESS;
        }

        $directory = dirname($databasePath);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        touch($databasePath);

        $display = $label ? "SQLite database '{$label}' ({$databasePath})" : "SQLite database '{$databasePath}'";
        $this->info("{$display} created.");

        return self::SUCCESS;
    }

    protected function createSqlSrvDatabase(array $config, $database)
    {
        $config['database'] = 'master';
        $dsn = $this->buildSqlSrvDsn($config);

        try {
            $pdo = new PDO($dsn, $config['username'] ?? null, $config['password'] ?? null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);

            $result = $pdo->query('SELECT 1 FROM sys.databases WHERE name = '.$pdo->quote($database));

            if ($result->fetchColumn()) {
                $this->info("Database '{$database}' already exists.");

                return self::SUCCESS;
            }

            $pdo->exec("CREATE DATABASE [{$database}]");

            $this->info("Database '{$database}' created.");

            return self::SUCCESS;
        } catch (\PDOException $e) {
            $this->error("Failed to create database '{$database}': ".$e->getMessage());

            return self::FAILURE;
        }
    }

    protected function buildMysqlDsn(array $config)
    {
        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? '3306';
        $unixSocket = $config['unix_socket'] ?? '';
        $charset = $config['charset'] ?? 'utf8mb4';

        if ($unixSocket) {
            return "mysql:unix_socket={$unixSocket};charset={$charset}";
        }

        return "mysql:host={$host};port={$port};charset={$charset}";
    }

    protected function buildPostgresDsn(array $config)
    {
        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? '5432';
        $database = $config['database'] ?? 'postgres';

        return "pgsql:host={$host};port={$port};dbname={$database}";
    }

    protected function buildSqlSrvDsn(array $config)
    {
        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? '1433';
        $database = $config['database'] ?? 'master';

        return "sqlsrv:Server={$host},{$port};Database={$database}";
    }
}
