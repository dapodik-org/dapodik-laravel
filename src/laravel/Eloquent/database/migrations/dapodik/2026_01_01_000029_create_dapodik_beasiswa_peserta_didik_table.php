<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\BeasiswaPesertaDidik;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikBeasiswaPesertaDidikTable extends Migration
{
    protected $model = BeasiswaPesertaDidik::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('beasiswa_peserta_didik_id')->primary();
            $table->uuid('peserta_didik_id');
            $table->integer('jenis_beasiswa_id');
            $table->string('keterangan', 80);
            $table->decimal('tahun_mulai', 4, 0);
            $table->decimal('tahun_selesai', 4, 0);
            $table->char('asal_data', 1)->default('1');
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
