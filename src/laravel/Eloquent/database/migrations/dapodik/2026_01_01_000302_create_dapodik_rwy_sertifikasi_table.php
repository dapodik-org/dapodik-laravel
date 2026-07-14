<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RwySertifikasi;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = RwySertifikasi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('riwayat_sertifikasi_id')->primary();
            $table->decimal('kode_lemb_sert', 5, 0);
            $table->uuid('ptk_id');
            $table->integer('bidang_studi_id');
            $table->decimal('id_jenis_sertifikasi', 3, 0);
            $table->date('tgl_sert');
            $table->date('tgl_exp_sert')->nullable();
            $table->string('nomor_sertifikat', 80);
            $table->string('nomer_registrasi', 80)->nullable();
            $table->string('nomor_peserta', 80)->nullable();
            $table->string('kualifikasi', 100)->nullable();
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
};
