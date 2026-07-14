<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPrasarana;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisPrasaranaTable extends Migration
{
    protected $model = JenisPrasarana::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jenis_prasarana_id')->primary();
            $table->string('nama');
            $table->boolean('a_unit_organisasi')->default(false);
            $table->boolean('a_tanah')->default(false);
            $table->boolean('a_bangunan')->default(false);
            $table->boolean('a_ruang')->default(false);
            $table->boolean('a_sub');
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
