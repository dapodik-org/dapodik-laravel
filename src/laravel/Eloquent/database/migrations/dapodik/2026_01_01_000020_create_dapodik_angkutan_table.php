<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Angkutan;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Angkutan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_angkutan')->primary();
            $table->uuid('sekolah_id');
            $table->uuid('ptk_id')->nullable();
            $table->integer('jenis_sarana_id');
            $table->char('id_hapus_buku', 1)->nullable();
            $table->decimal('kepemilikan_sarpras_id', 1, 0);
            $table->char('kd_kl', 3)->nullable();
            $table->string('kd_satker', 20)->nullable();
            $table->string('kd_brg', 10)->nullable();
            $table->integer('nup')->nullable();
            $table->string('kode_eselon1', 2)->nullable();
            $table->string('nama_eselon1', 255)->nullable();
            $table->string('kode_sub_satker', 3)->nullable();
            $table->string('nama_sub_satker', 255)->nullable();
            $table->string('nama', 100);
            $table->string('spesifikasi', 300)->nullable();
            $table->date('tgl_hapus_buku')->nullable();
            $table->string('merk', 255)->nullable();
            $table->string('no_polisi', 255)->nullable();
            $table->string('no_bpkb', 255)->nullable();
            $table->string('alamat', 255)->nullable();
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
