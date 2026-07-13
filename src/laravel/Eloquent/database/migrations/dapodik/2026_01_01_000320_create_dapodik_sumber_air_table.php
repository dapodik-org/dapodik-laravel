<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\SumberAir;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikSumberAirTable extends Migration
{
    protected $model = SumberAir::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('sumber_air_id')->primary();
            $table->string('nama');
            $table->boolean('sumber_air')->nullable();
            $table->boolean('sumber_minum')->nullable();
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
