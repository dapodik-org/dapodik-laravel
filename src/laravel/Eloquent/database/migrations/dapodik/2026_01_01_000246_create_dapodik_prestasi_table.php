<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Prestasi;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPrestasiTable extends Migration
{
    protected $model = Prestasi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('prestasi_id')->primary();
            $table->integer('jenis_prestasi_id');
            $table->integer('tingkat_prestasi_id');
            $table->uuid('peserta_didik_id');
            $table->string('nama', 40);
            $table->decimal('tahun_prestasi', 4, 0);
            $table->string('penyelenggara', 100)->nullable();
            $table->integer('peringkat')->nullable();
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
