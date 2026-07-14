<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisBantuan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisBantuanTable extends Migration
{
    protected $model = JenisBantuan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jenis_bantuan_id')->primary();
            $table->string('nama')->nullable();
            $table->boolean('untuk_sekolah');
            $table->boolean('untuk_pd');
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
