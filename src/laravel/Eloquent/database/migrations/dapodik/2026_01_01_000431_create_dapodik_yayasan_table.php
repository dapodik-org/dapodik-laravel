<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Yayasan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikYayasanTable extends Migration
{
    protected $model = Yayasan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('yayasan_id')->primary();
            $table->string('nama');
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
            $table->char('npyp', 10)->nullable();
            $table->string('nama_pimpinan_yayasan');
            $table->string('no_pendirian_yayasan')->nullable();
            $table->date('tanggal_pendirian_yayasan')->nullable();
            $table->string('nomor_pengesahan_pn_ln')->nullable();
            $table->string('nomor_sk_bn')->nullable();
            $table->date('tanggal_sk_bn')->nullable();
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
