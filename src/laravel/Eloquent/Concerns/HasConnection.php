<?php

namespace Dapodik\Laravel\Eloquent\Concerns;

use Dapodik\Laravel\Eloquent\Facades\Eloquent as EloquentFacade;
use Illuminate\Support\Str;

trait HasConnection
{
    protected $schema = null;

    public function getConnectionName()
    {
        if (! EloquentFacade::useSplitConnection()) {
            return EloquentFacade::getConfig()['connection'] ?? $this->connection ?? config('database.default');
        }

        $parts = $this->getNamespaceParts();
        $folder = $parts['folder'];
        $driver = $parts['driver'];

        return $folder ? "{$driver}_{$folder}" : $driver;
    }

    public function getTable()
    {
        $prefix = rtrim(EloquentFacade::getConfig()['prefix'] ?? '', '_') ?: null;
        $suffix = ltrim(EloquentFacade::getConfig()['suffix'] ?? '', '_') ?: null;
        $parts = $this->getNamespaceParts();

        $folder = $parts['folder'];
        $tableName = $parts['table'];

        if (EloquentFacade::useSplitConnection()) {
            if (EloquentFacade::getDriverName() === 'pgsql') {
                $this->setSchema($folder);
            }
        }

        $segments = array_filter([$prefix, $folder, $tableName, $suffix]);

        return implode('_', $segments);
    }

    private function getNamespaceParts()
    {
        $class = static::class;

        $afterModels = (string) Str::of($class)->after('Models\\Dapodik\\');

        if ($afterModels === (string) $class) {
            $afterModels = (string) Str::of($class)->after('Models\\');
        }

        if ($afterModels === (string) $class) {
            return [
                'driver' => EloquentFacade::getConnectionName(),
                'folder' => '',
                'table' => Str::snake(class_basename($class)),
            ];
        }

        $parts = explode('\\', $afterModels);
        $snakeParts = array_map(function ($part) {
            return Str::snake($part);
        }, $parts);

        if (count($snakeParts) === 1) {
            return [
                'driver' => EloquentFacade::getConnectionName(),
                'folder' => '',
                'table' => $snakeParts[0],
            ];
        }

        return [
            'driver' => EloquentFacade::getConnectionName(),
            'folder' => $snakeParts[0],
            'table' => $snakeParts[1] ?? $snakeParts[0],
        ];
    }

    public function getSchema()
    {
        $this->getTable();

        return $this->schema;
    }

    public function setSchema($schema)
    {
        $this->schema = $schema;
    }

    public function getGuarded()
    {
        return [];
    }
}
