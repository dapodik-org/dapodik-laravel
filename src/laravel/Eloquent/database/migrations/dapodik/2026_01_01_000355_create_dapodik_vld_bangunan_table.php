<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\VldBangunan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikVldBangunanTable extends Migration
{
    protected $model = VldBangunan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('logid')->primary();
            $table->uuid('id_bangunan');
            $table->integer('idtype');
            $table->decimal('status_validasi', 2, 0)->nullable();
            $table->string('field_error', 30)->nullable();
            $table->string('error_message', 150)->nullable();
            $table->string('app_username', 50)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->uuid('updater_id');
            $table->timestamp('last_sync')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->softDeletes('soft_delete');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
