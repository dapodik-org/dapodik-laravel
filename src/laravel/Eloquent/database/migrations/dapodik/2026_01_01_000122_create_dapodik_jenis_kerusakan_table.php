<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKerusakan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisKerusakanTable extends Migration
{
    protected $model = JenisKerusakan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('kerusakan_id')->primary();
            $table->string('klasifikasi');
            $table->boolean('u_bangunan');
            $table->boolean('u_ruang');
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
