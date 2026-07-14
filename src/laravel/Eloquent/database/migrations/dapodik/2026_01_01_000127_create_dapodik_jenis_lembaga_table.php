<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisLembaga;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisLembagaTable extends Migration
{
    protected $model = JenisLembaga::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jenis_lembaga_id')->primary();
            $table->string('nama');
            $table->boolean('tempat_pengawas');
            $table->boolean('simpul_pendataan');
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
