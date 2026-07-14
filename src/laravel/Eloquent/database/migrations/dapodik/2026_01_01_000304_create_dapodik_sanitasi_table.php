<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Sanitasi;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikSanitasiTable extends Migration
{
    protected $model = Sanitasi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('sekolah_id');
            $table->char('semester_id', 5);
            $table->primary(['sekolah_id', 'semester_id']);
            $table->decimal('sumber_air_id', 2, 0);
            $table->decimal('sumber_air_minum_id', 2, 0);
            $table->uuid('updater_id');
            $table->decimal('ketersediaan_air', 1, 0);
            $table->decimal('kecukupan_air', 1, 0);
            $table->decimal('minum_siswa', 1, 0);
            $table->decimal('memproses_air', 1, 0);
            $table->decimal('siswa_bawa_air', 1, 0);
            $table->decimal('toilet_siswa_laki', 2, 0);
            $table->decimal('toilet_siswa_perempuan', 2, 0);
            $table->decimal('toilet_siswa_kk', 2, 0);
            $table->decimal('toilet_siswa_kecil', 1, 0);
            $table->decimal('jml_jamban_l_g', 2, 0)->default(0);
            $table->decimal('jml_jamban_l_tg', 2, 0)->default(0);
            $table->decimal('jml_jamban_p_g', 2, 0)->default(0);
            $table->decimal('jml_jamban_p_tg', 2, 0)->default(0);
            $table->decimal('jml_jamban_lp_g', 2, 0)->default(0);
            $table->decimal('jml_jamban_lp_tg', 2, 0)->default(0);
            $table->decimal('tempat_cuci_tangan', 2, 0);
            $table->decimal('tempat_cuci_tangan_rusak', 2, 0);
            $table->decimal('a_sabun_air_mengalir', 1, 0);
            $table->decimal('jamban_difabel', 1, 0);
            $table->char('tipe_jamban', 1)->default('9');
            $table->decimal('a_sedia_pembalut', 1, 0)->nullable()->default(0);
            $table->decimal('kegiatan_cuci_tangan', 1, 0)->nullable();
            $table->decimal('pembuangan_air_limbah', 1, 0)->nullable();
            $table->decimal('a_kuras_septitank', 1, 0)->nullable();
            $table->decimal('a_memiliki_solokan', 1, 0)->nullable();
            $table->decimal('a_tempat_sampah_kelas', 1, 0)->nullable()->default(0);
            $table->decimal('a_tempat_sampah_tutup_p', 1, 0)->nullable()->default(0);
            $table->decimal('a_cermin_jamban_p', 1, 0)->nullable()->default(0);
            $table->decimal('a_memiliki_tps', 1, 0)->nullable()->default(0);
            $table->decimal('a_tps_angkut_rutin', 1, 0)->nullable()->default(0);
            $table->decimal('a_anggaran_sanitasi', 1, 0)->nullable()->default(0);
            $table->decimal('a_melibatkan_sanitasi_siswa', 1, 0)->nullable()->default(0);
            $table->decimal('a_kemitraan_san_daerah', 1, 0)->nullable();
            $table->decimal('a_kemitraan_san_puskesmas', 1, 0)->nullable();
            $table->decimal('a_kemitraan_san_swasta', 1, 0)->nullable();
            $table->decimal('a_kemitraan_san_non_pem', 1, 0)->nullable();
            $table->decimal('kie_guru_cuci_tangan', 1, 0)->nullable();
            $table->decimal('kie_guru_haid', 1, 0)->nullable();
            $table->decimal('kie_guru_perawatan_toilet', 1, 0)->nullable();
            $table->decimal('kie_guru_keamanan_pangan', 1, 0)->nullable();
            $table->decimal('kie_guru_minum_air', 1, 0)->nullable();
            $table->decimal('kie_kelas_cuci_tangan', 1, 0)->nullable();
            $table->decimal('kie_kelas_haid', 1, 0)->nullable();
            $table->decimal('kie_kelas_perawatan_toilet', 1, 0)->nullable();
            $table->decimal('kie_kelas_keamanan_pangan', 1, 0)->nullable();
            $table->decimal('kie_kelas_minum_air', 1, 0)->nullable();
            $table->decimal('kie_toilet_cuci_tangan', 1, 0)->nullable();
            $table->decimal('kie_toilet_haid', 1, 0)->nullable();
            $table->decimal('kie_toilet_perawatan_toilet', 1, 0)->nullable();
            $table->decimal('kie_toilet_keamanan_pangan', 1, 0)->nullable();
            $table->decimal('kie_toilet_minum_air', 1, 0)->nullable();
            $table->decimal('kie_selasar_cuci_tangan', 1, 0)->nullable();
            $table->decimal('kie_selasar_haid', 1, 0)->nullable();
            $table->decimal('kie_selasar_perawatan_toilet', 1, 0)->nullable();
            $table->decimal('kie_selasar_keamanan_pangan', 1, 0)->nullable();
            $table->decimal('kie_selasar_minum_air', 1, 0)->nullable();
            $table->decimal('kie_uks_cuci_tangan', 1, 0)->nullable();
            $table->decimal('kie_uks_haid', 1, 0)->nullable();
            $table->decimal('kie_uks_perawatan_toilet', 1, 0)->nullable();
            $table->decimal('kie_uks_keamanan_pangan', 1, 0)->nullable();
            $table->decimal('kie_uks_minum_air', 1, 0)->nullable();
            $table->decimal('kie_kantin_cuci_tangan', 1, 0)->nullable();
            $table->decimal('kie_kantin_haid', 1, 0)->nullable();
            $table->decimal('kie_kantin_perawatan_toilet', 1, 0)->nullable();
            $table->decimal('kie_kantin_keamanan_pangan', 1, 0)->nullable();
            $table->decimal('kie_kantin_minum_air', 1, 0)->nullable();
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
