<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JadwalPaud;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJadwalPaudTable extends Migration
{
    protected $model = JadwalPaud::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jadwal_id')->primary();
            $table->string('nama');
            $table->boolean('kesehatan');
            $table->boolean('pamts');
            $table->boolean('ddtk');
            $table->boolean('freq_parenting');
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
