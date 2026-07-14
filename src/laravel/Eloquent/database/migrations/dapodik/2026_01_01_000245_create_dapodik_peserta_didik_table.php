<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\PesertaDidik;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = PesertaDidik::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('peserta_didik_id')->primary();
            $table->string('nama');
            $table->char('jenis_kelamin', 1);
            $table->char('nisn', 10)->nullable();
            $table->char('nik', 16)->nullable();
            $table->char('no_kk', 16)->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->bigInteger('agama_id');
            $table->bigInteger('kebutuhan_khusus_id');
            $table->string('alamat_jalan');
            $table->decimal('rt', 2, 0)->nullable();
            $table->decimal('rw', 2, 0)->nullable();
            $table->string('nama_dusun')->nullable();
            $table->string('desa_kelurahan');
            $table->char('kode_wilayah', 8);
            $table->char('kode_pos', 5)->nullable();
            $table->decimal('lintang', 18, 12)->nullable();
            $table->decimal('bujur', 18, 12)->nullable();
            $table->bigInteger('jenis_tinggal_id')->nullable();
            $table->bigInteger('alat_transportasi_id')->nullable();
            $table->char('nik_ayah', 16)->nullable();
            $table->char('nik_ibu', 16)->nullable();
            $table->decimal('anak_keberapa', 2, 0)->nullable();
            $table->char('nik_wali', 16)->nullable();
            $table->string('nomor_telepon_rumah')->nullable();
            $table->string('nomor_telepon_seluler')->nullable();
            $table->string('email')->nullable();
            $table->boolean('penerima_kps');
            $table->string('no_kps')->nullable();
            $table->boolean('layak_pip')->default(false);
            $table->boolean('penerima_kip');
            $table->string('no_kip')->nullable();
            $table->string('nm_kip')->nullable();
            $table->string('no_kks')->nullable();
            $table->string('reg_akta_lahir')->nullable();
            $table->bigInteger('id_layak_pip')->nullable();
            $table->char('id_bank', 3)->nullable();
            $table->string('rekening_bank')->nullable();
            $table->string('nama_kcp')->nullable();
            $table->string('rekening_atas_nama')->nullable();
            $table->integer('status_data')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->decimal('tahun_lahir_ayah', 4, 0)->nullable();
            $table->bigInteger('jenjang_pendidikan_ayah')->nullable();
            $table->bigInteger('pekerjaan_id_ayah')->nullable();
            $table->bigInteger('penghasilan_id_ayah')->nullable();
            $table->bigInteger('kebutuhan_khusus_id_ayah');
            $table->string('nama_ibu_kandung');
            $table->decimal('tahun_lahir_ibu', 4, 0)->nullable();
            $table->bigInteger('jenjang_pendidikan_ibu')->nullable();
            $table->bigInteger('penghasilan_id_ibu')->nullable();
            $table->bigInteger('pekerjaan_id_ibu')->nullable();
            $table->bigInteger('kebutuhan_khusus_id_ibu');
            $table->string('nama_wali')->nullable();
            $table->decimal('tahun_lahir_wali', 4, 0)->nullable();
            $table->bigInteger('jenjang_pendidikan_wali')->nullable();
            $table->bigInteger('pekerjaan_id_wali')->nullable();
            $table->bigInteger('penghasilan_id_wali')->nullable();
            $table->char('kewarganegaraan', 2);
            $table->bigInteger('pekerjaan_id')->nullable();
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
