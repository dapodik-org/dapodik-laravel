<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisTunjangan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisTunjanganTable extends Migration
{
    protected $model = JenisTunjangan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('jenis_tunjangan_id')->primary();
            $table->string('nama')->nullable();
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
