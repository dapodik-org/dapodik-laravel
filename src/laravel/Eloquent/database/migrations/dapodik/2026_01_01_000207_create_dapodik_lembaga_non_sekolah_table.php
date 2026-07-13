<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\LembagaNonSekolah;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikLembagaNonSekolahTable extends Migration
{
    protected $model = LembagaNonSekolah::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('lembaga_id')->primary();
            $table->string('nama', 250);
            $table->string('singkatan', 15)->nullable();
            $table->decimal('jenis_lembaga_id', 5, 0);
            $table->string('alamat_jalan', 250);
            $table->decimal('rt', 2, 0)->nullable();
            $table->decimal('rw', 2, 0)->nullable();
            $table->string('nama_dusun', 60)->nullable();
            $table->string('desa_kelurahan', 60);
            $table->char('kode_wilayah', 8);
            $table->char('kode_pos', 5)->nullable();
            $table->decimal('lintang', 18, 12)->nullable();
            $table->decimal('bujur', 18, 12)->nullable();
            $table->string('nomor_telepon', 20)->nullable();
            $table->string('nomor_fax', 20)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('website', 100)->nullable();
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
