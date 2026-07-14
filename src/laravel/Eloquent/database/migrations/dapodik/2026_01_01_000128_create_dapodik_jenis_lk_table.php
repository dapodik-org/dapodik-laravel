<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisLk;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisLkTable extends Migration
{
    protected $model = JenisLk::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->char('id_jenis_lk', 6)->primary();
            $table->string('nm_jenis_lk');
            $table->string('ket_jenis_lk')->nullable();
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
