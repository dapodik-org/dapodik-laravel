<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\SyncSession;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = SyncSession::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('token')->primary();
            $table->uuid('id_instalasi');
            $table->uuid('pengguna_id');
            $table->timestamp('create_time')->default('2019-09-10 14:29:59.566693');
            $table->timestamp('last_activity')->nullable()->default('2019-09-10 14:29:59.566693');
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
        });
    }

    public function down()
    {
        $this->dropTable();
    }
};
