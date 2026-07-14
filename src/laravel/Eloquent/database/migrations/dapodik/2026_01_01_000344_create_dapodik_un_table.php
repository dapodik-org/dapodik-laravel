<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Nilai\Un;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikUnTable extends Migration
{
    protected $model = Un::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('un_id')->primary();
            $table->uuid('registrasi_id');
            $table->integer('tahun_ajaran_id');
            $table->date('un_tgl_daftar');
            $table->string('nomor_un')->nullable();
            $table->string('no_skhun', 1)->nullable();
            $table->decimal('nilai_1', 5, 2)->nullable();
            $table->decimal('nilai_2', 5, 2)->nullable();
            $table->decimal('nilai_3', 5, 2)->nullable();
            $table->decimal('nilai_4', 5, 2)->nullable();
            $table->decimal('nilai_5', 5, 2)->nullable();
            $table->decimal('nilai_6', 5, 2)->nullable();
            $table->decimal('nilai_7', 5, 2)->nullable();
            $table->uuid('template_id');
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
