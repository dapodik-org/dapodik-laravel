<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenjangPendidikan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenjangPendidikanTable extends Migration
{
    protected $model = JenjangPendidikan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jenjang_pendidikan_id')->primary();
            $table->string('nama');
            $table->boolean('jenjang_lembaga');
            $table->boolean('jenjang_orang');
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
