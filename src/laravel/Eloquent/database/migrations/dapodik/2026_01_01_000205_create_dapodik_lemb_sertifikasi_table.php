<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\LembSertifikasi;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikLembSertifikasiTable extends Migration
{
    protected $model = LembSertifikasi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('kode_lemb_sert')->primary();
            $table->string('nm_lemb_sert')->nullable();
            $table->date('tmt_lemb_sert')->nullable();
            $table->string('ket_lemb_sert')->nullable();
            $table->string('alamat_jalan')->nullable();
            $table->decimal('rt', 2, 0)->nullable();
            $table->decimal('rw', 2, 0)->nullable();
            $table->string('nama_dusun')->nullable();
            $table->string('desa_kelurahan')->nullable();
            $table->char('kode_wilayah', 8)->nullable();
            $table->char('kode_pos', 5)->nullable();
            $table->decimal('lintang', 18, 12)->nullable();
            $table->decimal('bujur', 18, 12)->nullable();
            $table->string('nama')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('nomor_fax')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->timestamp('last_sync')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->softDeletes('expired_date');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
