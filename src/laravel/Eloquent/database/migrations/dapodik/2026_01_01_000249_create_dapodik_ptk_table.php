<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ptk;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPtkTable extends Migration
{
    protected $model = Ptk::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('ptk_id')->primary();
            $table->string('nama');
            $table->char('nip', 18)->nullable();
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->char('nik', 16);
            $table->char('no_kk', 16)->nullable();
            $table->string('niy_nigk')->nullable();
            $table->char('nuptk', 16)->nullable();
            $table->string('nrg')->nullable();
            $table->string('nuks')->nullable();
            $table->bigInteger('status_kepegawaian_id');
            $table->bigInteger('pengawas_bidang_studi_id')->nullable();
            $table->bigInteger('agama_id');
            $table->string('alamat_jalan');
            $table->decimal('rt', 2, 0)->nullable();
            $table->decimal('rw', 2, 0)->nullable();
            $table->string('nama_dusun')->nullable();
            $table->string('desa_kelurahan');
            $table->char('kode_wilayah', 8);
            $table->char('kode_pos', 5)->nullable();
            $table->decimal('lintang', 18, 12)->nullable();
            $table->decimal('bujur', 18, 12)->nullable();
            $table->string('no_telepon_rumah')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('status_keaktifan_id');
            $table->string('sk_cpns')->nullable();
            $table->date('tgl_cpns')->nullable();
            $table->string('sk_pengangkatan')->nullable();
            $table->date('tmt_pengangkatan')->nullable();
            $table->bigInteger('lembaga_pengangkat_id');
            $table->bigInteger('pangkat_golongan_id')->nullable();
            $table->bigInteger('keahlian_laboratorium_id')->nullable();
            $table->bigInteger('sumber_gaji_id');
            $table->string('nama_ibu_kandung');
            $table->decimal('status_perkawinan', 1, 0);
            $table->string('nama_suami_istri')->nullable();
            $table->char('nip_suami_istri', 18)->nullable();
            $table->bigInteger('pekerjaan_suami_istri');
            $table->date('tmt_pns')->nullable();
            $table->boolean('sudah_lisensi_kepala_sekolah');
            $table->smallInteger('jumlah_sekolah_binaan')->nullable();
            $table->boolean('pernah_diklat_kepengawasan');
            $table->string('nm_wp')->nullable();
            $table->integer('status_data')->nullable();
            $table->string('karpeg')->nullable();
            $table->string('karpas')->nullable();
            $table->bigInteger('mampu_handle_kk');
            $table->boolean('keahlian_braille')->nullable()->default(0);
            $table->boolean('keahlian_bhs_isyarat')->nullable()->default(0);
            $table->bigInteger('kebutuhan_khusus_id');
            $table->char('npwp', 25)->nullable();
            $table->char('kewarganegaraan', 2);
            $table->char('id_bank', 3)->nullable();
            $table->string('rekening_bank')->nullable();
            $table->string('rekening_atas_nama')->nullable();
            $table->uuid('blob_id')->nullable();
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
