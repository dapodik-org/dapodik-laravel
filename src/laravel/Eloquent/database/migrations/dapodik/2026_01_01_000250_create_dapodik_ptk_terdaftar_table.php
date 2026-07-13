<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\PtkTerdaftar;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPtkTerdaftarTable extends Migration
{
    protected $model = PtkTerdaftar::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('ptk_terdaftar_id')->primary();
            $table->uuid('ptk_id');
            $table->uuid('sekolah_id');
            $table->char('jenis_keluar_id', 1)->nullable();
            $table->decimal('jabatan_ptk_id', 5, 0);
            $table->decimal('tahun_ajaran_id', 4, 0);
            $table->decimal('jenis_ptk_id', 2, 0);
            $table->string('nomor_surat_tugas', 80);
            $table->date('tanggal_surat_tugas');
            $table->decimal('ptk_induk', 1, 0);
            $table->date('tmt_tugas');
            $table->decimal('aktif_bulan_01', 1, 0)->default(0);
            $table->decimal('aktif_bulan_02', 1, 0)->default(0);
            $table->decimal('aktif_bulan_03', 1, 0)->default(0);
            $table->decimal('aktif_bulan_04', 1, 0)->default(0);
            $table->decimal('aktif_bulan_05', 1, 0)->default(0);
            $table->decimal('aktif_bulan_06', 1, 0)->default(0);
            $table->decimal('aktif_bulan_07', 1, 0)->default(0);
            $table->decimal('aktif_bulan_08', 1, 0)->default(0);
            $table->decimal('aktif_bulan_09', 1, 0)->default(0);
            $table->decimal('aktif_bulan_10', 1, 0)->default(0);
            $table->decimal('aktif_bulan_11', 1, 0)->default(0);
            $table->decimal('aktif_bulan_12', 1, 0)->default(0);
            $table->date('tgl_ptk_keluar')->nullable();
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
