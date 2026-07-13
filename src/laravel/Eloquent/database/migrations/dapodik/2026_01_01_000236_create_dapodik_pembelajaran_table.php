<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pembelajaran;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPembelajaranTable extends Migration
{
    protected $model = Pembelajaran::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('pembelajaran_id')->primary();
            $table->uuid('rombongan_belajar_id');
            $table->char('semester_id', 5);
            $table->integer('mata_pelajaran_id');
            $table->uuid('ptk_terdaftar_id');
            $table->string('sk_mengajar', 80);
            $table->date('tanggal_sk_mengajar');
            $table->decimal('jam_mengajar_per_minggu', 2, 0);
            $table->decimal('status_di_kurikulum', 2, 0);
            $table->string('nama_mata_pelajaran', 50);
            $table->uuid('induk_pembelajaran_id')->nullable();
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
