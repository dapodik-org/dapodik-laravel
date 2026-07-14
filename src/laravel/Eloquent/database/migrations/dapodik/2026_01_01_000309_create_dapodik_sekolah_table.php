<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Sekolah;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Sekolah::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('sekolah_id')->primary();
            $table->string('nama');
            $table->string('nama_nomenklatur')->nullable();
            $table->char('nss', 12)->nullable();
            $table->char('npsn', 8)->nullable();
            $table->bigInteger('bentuk_pendidikan_id');
            $table->string('alamat_jalan');
            $table->decimal('rt', 2, 0)->nullable();
            $table->decimal('rw', 2, 0)->nullable();
            $table->string('nama_dusun')->nullable();
            $table->string('desa_kelurahan');
            $table->char('kode_wilayah', 8);
            $table->char('kode_pos', 5)->nullable();
            $table->decimal('lintang', 18, 12)->nullable();
            $table->decimal('bujur', 18, 12)->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('nomor_fax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->bigInteger('kebutuhan_khusus_id');
            $table->decimal('status_sekolah', 1, 0);
            $table->string('sk_pendirian_sekolah')->nullable();
            $table->date('tanggal_sk_pendirian')->nullable();
            $table->bigInteger('status_kepemilikan_id');
            $table->uuid('yayasan_id')->nullable();
            $table->string('sk_izin_operasional')->nullable();
            $table->date('tanggal_sk_izin_operasional')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('cabang_kcp_unit')->nullable();
            $table->string('rekening_atas_nama')->nullable();
            $table->boolean('mbs');
            $table->decimal('luas_tanah_milik', 7, 0);
            $table->decimal('luas_tanah_bukan_milik', 7, 0);
            $table->bigInteger('kode_registrasi')->nullable();
            $table->char('npwp', 25)->nullable();
            $table->string('nm_wp')->nullable();
            $table->boolean('keaktifan')->default(true);
            $table->char('flag', 3)->nullable();
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
