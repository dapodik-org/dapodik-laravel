<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Penghargaan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPenghargaanTable extends Migration
{
    protected $model = Penghargaan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('penghargaan_id')->primary();
            $table->integer('tingkat_penghargaan_id');
            $table->uuid('ptk_id');
            $table->integer('jenis_penghargaan_id');
            $table->string('nama', 50);
            $table->decimal('tahun', 4, 0);
            $table->string('instansi', 100)->nullable();
            $table->char('asal_data', 1)->default('1');
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
