<?php

namespace Dapodik\Laravel\Eloquent;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use InvalidArgumentException;

class EloquentManager
{
    use Macroable {
        __call as macroCall;
    }

    protected $laravel;

    protected $config;

    protected $driver;

    protected $baseConnectionName;

    protected $connections = [];

    public function __construct(Application $laravel)
    {
        $this->laravel = $laravel;
        $this->config = $this->getConfig();
        $this->driver = $this->getDriverName();
        $this->baseConnectionName = $this->config['connection'] ?? Schema::getConnection()->getName();

        $this->createConnections($this->useSplitConnection());
    }

    private function createConnections($useSplitConnection)
    {
        $paths = File::directories(__DIR__.'/Models');
        $directoryNames = array_map(function($path) {
            return Str::snake(basename($path));
        }, $paths);

        $baseConnection = $this->getConnectionName();

        if (!Config::has("database.connections.{$baseConnection}")) {
            $templateConnection = Schema::getConnection()->getName();
            $templateConfig = Config::get("database.connections.{$templateConnection}");

            if ($templateConfig) {
                Config::set("database.connections.{$baseConnection}", $templateConfig);
            }
        }

        if ($this->getDriverName() === 'pgsql') {
            $currentSchema = Config::get("database.connections.{$baseConnection}.schema", 'public');
            $currentSchemas = array_map('trim', explode(',', $currentSchema));

            foreach ($directoryNames as $directoryName) {
                if (!in_array($directoryName, $currentSchemas, true)) {
                    $currentSchemas[] = $directoryName;
                }
            }

            Config::set("database.connections.{$baseConnection}.schema", implode(', ', $currentSchemas));
        }

        if (!$useSplitConnection) {
            return;
        }

        $baseConnection = $this->getConnectionName();
        $baseConfig = Config::get("database.connections.{$baseConnection}");

        if (!$baseConfig) {
            throw new \RuntimeException("Base database connection '{$baseConnection}' configuration not found.");
        }

        foreach ($directoryNames as $directoryName) {
            $newConnectionName = "{$baseConnection}_{$directoryName}";

            $this->setConnections($newConnectionName);

            Config::set("database.connections.{$newConnectionName}", $baseConfig);

            switch ($this->getDriverName()) {
                case 'pgsql':
                    Config::set("database.connections.{$newConnectionName}.search_path", $directoryName);
                    break;

                case 'mysql':
                case 'mariadb':
                case 'sqlsrv':
                    $currentDb = $baseConfig['database'] ?? '';
                    Config::set("database.connections.{$newConnectionName}.database", "{$currentDb}_{$directoryName}");
                    break;

                case 'sqlite':
                    $currentDbPath = $baseConfig['database'] ?? '';
                    if ($currentDbPath !== ':memory:') {
                        $directory = dirname($currentDbPath);
                        $pathInfo = pathinfo($currentDbPath);

                        $newPath = $directory.DIRECTORY_SEPARATOR.$pathInfo['filename'].'_'.$directoryName.'.'.($pathInfo['extension'] ?? 'sqlite');

                        if (!file_exists($newPath)) {
                            if (!is_dir($directory)) {
                                mkdir($directory, 0755, true);
                            }
                            touch($newPath);
                        }

                        Config::set("database.connections.{$newConnectionName}.database", $newPath);
                    }
                    break;
            }
        }
    }

    public function useSplitConnection()
    {
        return $this->config['split_connection'];
    }

    public function dropAllTables()
    {
        if (!$this->useSplitConnection()) {
            return;
        }

        foreach ($this->getConnections() as $connection) {
            Schema::connection($connection)->dropAllTables();
        }
    }

    public function dropConnectionTables($connection = null)
    {
        Schema::connection($connection ?? $this->getConnectionName())->dropAllTables();
    }

    public function getDriverName()
    {
        $driver = Schema::getConnection()->getDriverName();
        if (!in_array($driver, $this->supportedDrivers(), true)) {
            throw new InvalidArgumentException(
                "The database driver '{$driver}' is not supported. Supported drivers are: ".implode(', ', $this->supportedDrivers())
            );
        }

        return $driver;
    }

    protected function supportedDrivers()
    {
        return ['mysql', 'mariadb', 'pgsql', 'sqlsrv', 'sqlite'];
    }

    public function getConnectionName()
    {
        return $this->baseConnectionName;
    }

    public function getConfig()
    {
        $config = $this->laravel['config']['dapodik-eloquent'];

        if ($config === null) {
            $config = require __DIR__.'/config/dapodik-eloquent.php';
        }

        $type = [
            'prefix' => 'null|string',
            'suffix' => 'null|string',
            'connection' => 'null|string',
            'split_connection' => 'boolean',
            'skip_fresh' => 'boolean',
            'exclude_tables' => 'array',
        ];

        return $this->validateConfig($config, $type);
    }

    private function validateConfig(array $config, array $type)
    {
        foreach ($type as $key => $expectedTypes) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing required configuration key: '{$key}'");
            }

            $value = $config[$key];
            $currentType = gettype($value);

            if ($currentType === 'NULL') {
                $currentType = 'null';
            }
            if ($currentType === 'integer') {
                $currentType = 'int';
            }

            $allowedTypes = explode('|', $expectedTypes);

            if (!in_array($currentType, $allowedTypes)) {
                throw new InvalidArgumentException(
                    "Invalid config type for '{$key}'. Expected '{$expectedTypes}', got '{$currentType}'."
                );
            }
        }

        return $config;
    }

    public function getConnections()
    {
        return $this->connections;
    }

    private function setConnections($connection)
    {
        $this->connections[] = $connection;
    }
}
