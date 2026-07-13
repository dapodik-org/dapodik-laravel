<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\SekolahPaud;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikSekolahPaudTable extends Migration
{
    protected $model = SekolahPaud::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('sekolah_id');
            $table->char('semester_id', 5);
            $table->primary(['sekolah_id', 'semester_id']);
            $table->decimal('kategori_tk_id', 2, 0);
            $table->decimal('klasifikasi_lembaga_id', 2, 0);
            $table->decimal('sumber_dana_sekolah_id', 2, 0);
            $table->decimal('fasilitas_layanan_id', 2, 0);
            $table->decimal('jadwal_pmtas', 2, 0);
            $table->decimal('lembaga_pengangkat_id', 2, 0);
            $table->decimal('jadwal_ddtk', 2, 0);
            $table->decimal('freq_parenting', 2, 0);
            $table->decimal('bentuk_lembaga_id', 2, 0);
            $table->decimal('jadwal_kesehatan', 2, 0);
            $table->decimal('izin_paud', 1, 0);
            $table->decimal('pencatatan_ddtk', 1, 0);
            $table->decimal('rujukan_ddtk', 1, 0);
            $table->decimal('pelaksanaan_parenting', 1, 0);
            $table->decimal('parenting_kpo', 1, 0);
            $table->decimal('parenting_kelas', 1, 0);
            $table->decimal('parenting_kegiatan', 1, 0);
            $table->decimal('parenting_konsultasi', 1, 0);
            $table->decimal('parenting_kunjungan', 1, 0);
            $table->decimal('parenting_lainnya', 1, 0);
            $table->string('nilk', 20)->nullable();
            $table->string('nilm', 20)->nullable();
            $table->string('no_penetapan_pnf', 80)->nullable();
            $table->date('tanggal_penetapan_pnf')->nullable();
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
