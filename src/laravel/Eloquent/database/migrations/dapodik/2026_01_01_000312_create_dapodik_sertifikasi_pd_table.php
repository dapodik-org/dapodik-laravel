<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\SertifikasiPd;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikSertifikasiPdTable extends Migration
{
    protected $model = SertifikasiPd::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_sert_pd')->primary();
            $table->decimal('id_jenis_sertifikasi', 3, 0);
            $table->uuid('peserta_didik_id');
            $table->integer('bidang_studi_id');
            $table->string('no_sert_pd', 30);
            $table->date('tgl_sert_pd');
            $table->date('tgl_exp_sert_pd')->nullable();
            $table->string('no_peserta_sert_pd', 30)->nullable();
            $table->string('no_registrasi', 80)->nullable();
            $table->string('kualifikasi', 100)->nullable();
            $table->decimal('kode_lemb_sert', 5, 0);
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
