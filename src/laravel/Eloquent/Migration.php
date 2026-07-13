<?php

namespace Dapodik\Laravel\Eloquent;

use Dapodik\Laravel\Eloquent\Facades\Eloquent as EloquentFacade;
use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

abstract class Migration extends BaseMigration
{
    protected $model;

    public function getConnection()
    {
        if (EloquentFacade::useSplitConnection()) {
            return app($this->getModel())->getConnectionName();
        }

        return EloquentFacade::getConfig()['connection'] ?? parent::getConnection() ?? config('database.default');
    }

    public function createSchemaIfNotExist()
    {
        if (EloquentFacade::useSplitConnection() && EloquentFacade::getDriverName() === 'pgsql') {
            $schema = method_exists(app($this->getModel()), 'getSchema')
                ? app($this->getModel())->getSchema()
                : null;

            if ($schema) {
                DB::connection($this->getConnection())->statement("CREATE SCHEMA IF NOT EXISTS {$schema}");
            }
        }
    }

    public function createTable(\Closure $blueprint)
    {
        if (!Schema::connection($this->getConnection())->hasTable($this->getTable())) {
            Schema::connection($this->getConnection())->create($this->getTable(), function(Blueprint $table) use ($blueprint) {
                $blueprint($table);
            });
        }
    }

    public function dropTable()
    {
        Schema::connection($this->getConnection())->dropIfExists($this->getTable());
    }

    public function dropColumns($columns)
    {
        $columns = (array) $columns;
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) use ($columns) {
            $table->dropColumn($columns);
        });
    }

    public function getTable()
    {
        return app($this->getModel())->getTable();
    }

    public function getModel()
    {
        return $this->model;
    }
}
