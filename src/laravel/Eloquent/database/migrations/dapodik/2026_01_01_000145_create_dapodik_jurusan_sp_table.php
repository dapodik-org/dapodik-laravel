<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\JurusanSp;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJurusanSpTable extends Migration
{
    protected $model = JurusanSp::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('jurusan_sp_id')->primary();
            $table->uuid('sekolah_id');
            $table->integer('kebutuhan_khusus_id');
            $table->string('jurusan_id', 25);
            $table->string('nama_jurusan_sp', 60);
            $table->string('sk_izin', 80)->nullable();
            $table->date('tanggal_sk_izin')->nullable();
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
