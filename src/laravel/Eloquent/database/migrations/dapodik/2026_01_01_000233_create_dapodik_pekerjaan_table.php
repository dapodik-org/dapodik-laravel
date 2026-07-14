<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\Pekerjaan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPekerjaanTable extends Migration
{
    protected $model = Pekerjaan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('pekerjaan_id')->primary();
            $table->string('nama')->nullable();
            $table->boolean('a_wirausaha')->default(false);
            $table->boolean('a_pejabat_publik')->default(false);
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
