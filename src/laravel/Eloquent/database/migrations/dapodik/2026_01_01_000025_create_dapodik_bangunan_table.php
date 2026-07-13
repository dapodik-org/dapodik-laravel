<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Bangunan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikBangunanTable extends Migration
{
    protected $model = Bangunan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_bangunan')->primary();
            $table->integer('jenis_prasarana_id');
            $table->uuid('sekolah_id');
            $table->uuid('id_tanah')->nullable();
            $table->uuid('ptk_id')->nullable();
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
            $table->decimal('jml_lantai', 3, 0)->default(1);
            $table->decimal('thn_dibangun', 4, 0)->nullable();
            $table->decimal('luas_tapak_bangunan', 7, 1)->nullable();
            $table->decimal('vol_pondasi_m3', 7, 1)->nullable();
            $table->decimal('vol_sloop_kolom_balok_m3', 7, 1)->nullable();
            $table->decimal('panj_kudakuda_m', 7, 1)->nullable();
            $table->decimal('vol_kudakuda_m3', 7, 1)->nullable();
            $table->decimal('panj_kaso_m', 7, 1)->nullable();
            $table->decimal('panj_reng_m', 7, 1)->nullable();
            $table->decimal('luas_tutup_atap_m2', 7, 1)->nullable();
            $table->string('kd_satker_tanah', 255)->nullable();
            $table->string('nm_satker_tanah', 255)->nullable();
            $table->string('kd_brg_tanah', 255)->nullable();
            $table->string('nm_brg_tanah', 255)->nullable();
            $table->string('nup_brg_tanah', 255)->nullable();
            $table->date('tgl_sk_pemakai')->nullable();
            $table->date('tgl_hapus_buku')->nullable();
            $table->string('ket_bangunan', 250)->nullable();
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
