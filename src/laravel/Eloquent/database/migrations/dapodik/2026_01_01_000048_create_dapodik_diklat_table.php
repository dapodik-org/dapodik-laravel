<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Diklat;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikDiklatTable extends Migration
{
    protected $model = Diklat::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('diklat_id')->primary();
            $table->integer('jenis_diklat_id');
            $table->uuid('ptk_id');
            $table->string('nama', 50);
            $table->string('penyelenggara', 100)->nullable();
            $table->decimal('tahun', 4, 0);
            $table->string('peran', 30)->nullable();
            $table->decimal('tingkat', 2, 0)->nullable();
            $table->decimal('berapa_jam', 4, 0);
            $table->string('sertifikat_diklat', 80)->nullable();
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
