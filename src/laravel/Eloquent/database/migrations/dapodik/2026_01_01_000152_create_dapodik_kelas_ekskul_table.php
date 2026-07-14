<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\KelasEkskul;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikKelasEkskulTable extends Migration
{
    protected $model = KelasEkskul::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_kelas_ekskul')->primary();
            $table->uuid('rombongan_belajar_id');
            $table->integer('id_ekskul');
            $table->string('nm_ekskul', 80);
            $table->string('sk_ekskul', 80);
            $table->date('tgl_sk_ekskul')->nullable();
            $table->decimal('jam_kegiatan_per_minggu', 2, 0)->nullable();
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
