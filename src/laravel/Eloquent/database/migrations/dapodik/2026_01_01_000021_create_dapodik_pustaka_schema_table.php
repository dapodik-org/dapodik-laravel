<?php

use Dapodik\Laravel\Eloquent\Facades\Eloquent as EloquentFacade;
use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Author;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    protected $model = Author::class;

    public function getConnection()
    {
        return EloquentFacade::getConfig()['connection'] ?? config('database.default');
    }

    public function up()
    {
        $driver = EloquentFacade::getDriverName();
        $schema = $this->getSchemaName();

        if ($driver === 'pgsql') {
            DB::statement("CREATE SCHEMA IF NOT EXISTS {$schema}");

            if (DB::getSchemaBuilder()->hasTable('author')) {
                DB::statement("ALTER TABLE author SET SCHEMA {$schema}");
            }

            return;
        }

        if ($driver === 'sqlite') {
            if (DB::getSchemaBuilder()->hasTable('author')) {
                DB::statement("ALTER TABLE author RENAME TO {$schema}_author");
            }

            return;
        }

        if ($driver === 'mysql' || $driver === 'sqlsrv') {
            if (DB::getSchemaBuilder()->hasTable('author')) {
                DB::statement("ALTER TABLE author RENAME TO {$schema}_author");
            }

            return;
        }
    }

    public function down()
    {
        $driver = EloquentFacade::getDriverName();
        $schema = $this->getSchemaName();

        if ($driver === 'pgsql') {
            if (DB::getSchemaBuilder()->hasTable("{$schema}.author")) {
                DB::statement("ALTER TABLE {$schema}.author SET SCHEMA public");
            }

            return;
        }

        if (DB::getSchemaBuilder()->hasTable("{$schema}_author")) {
            DB::statement("ALTER TABLE {$schema}_author RENAME TO author");
        }
    }

    protected function getSchemaName(): string
    {
        if (EloquentFacade::useSplitConnection() && EloquentFacade::getDriverName() === 'pgsql') {
            return app($this->getModel())->getSchema();
        }

        return 'pustaka';
    }
};
