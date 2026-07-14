<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\KaryaTulis;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikKaryaTulisTable extends Migration
{
    protected $model = KaryaTulis::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('karya_tulis_id')->primary();
            $table->uuid('ptk_id');
            $table->string('judul', 200);
            $table->decimal('tahun_pembuatan', 4, 0);
            $table->string('publikasi', 150)->nullable();
            $table->string('keterangan', 200)->nullable();
            $table->string('url_publikasi', 120)->nullable();
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
