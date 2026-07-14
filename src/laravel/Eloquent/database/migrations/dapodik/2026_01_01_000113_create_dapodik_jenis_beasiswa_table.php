<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisBeasiswa;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisBeasiswaTable extends Migration
{
    protected $model = JenisBeasiswa::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jenis_beasiswa_id')->primary();
            $table->bigInteger('sumber_dana_id');
            $table->string('nama');
            $table->boolean('untuk_pd');
            $table->boolean('untuk_ptk');
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
