<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Tanah;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikTanahTable extends Migration
{
    protected $model = Tanah::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_tanah')->primary();
            $table->integer('jenis_prasarana_id');
            $table->uuid('sekolah_id');
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
            $table->float('panjang')->nullable();
            $table->float('lebar')->nullable();
            $table->decimal('nilai_perolehan_aset', 20, 2)->nullable();
            $table->char('kode_wilayah', 8);
            $table->string('alamat_jalan', 80);
            $table->decimal('rt', 2, 0)->nullable();
            $table->decimal('rw', 2, 0)->nullable();
            $table->string('nama_dusun', 60)->nullable();
            $table->string('desa_kelurahan', 60);
            $table->char('kode_pos', 5)->nullable();
            $table->decimal('lintang', 18, 12)->nullable();
            $table->decimal('bujur', 18, 12)->nullable();
            $table->date('tgl_mutasi_keluar')->nullable();
            $table->text('batas')->nullable();
            $table->string('ket_tanah', 250)->nullable();
            $table->decimal('luas', 10, 1);
            $table->decimal('luas_lahan_tersedia', 10, 1);
            $table->string('no_sertifikat_tanah', 16);
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
