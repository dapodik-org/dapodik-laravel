<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RombonganBelajar;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikRombonganBelajarTable extends Migration
{
    protected $model = RombonganBelajar::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('rombongan_belajar_id')->primary();
            $table->char('semester_id', 5);
            $table->uuid('id_ruang');
            $table->uuid('sekolah_id');
            $table->decimal('tingkat_pendidikan_id', 2, 0);
            $table->uuid('jurusan_sp_id')->nullable();
            $table->smallInteger('kurikulum_id');
            $table->string('nama', 30);
            $table->uuid('ptk_id')->nullable();
            $table->decimal('moving_class', 1, 0);
            $table->decimal('jenis_rombel', 2, 0);
            $table->decimal('sks', 2, 0)->default(0);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('kebutuhan_khusus_id');
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
