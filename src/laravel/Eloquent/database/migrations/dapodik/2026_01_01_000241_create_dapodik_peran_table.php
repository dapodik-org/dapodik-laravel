<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Peran;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Peran::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->integer('peran_id')->primary();
            $table->smallInteger('bentuk_pendidikan_id');
            $table->string('nama')->nullable();
            $table->boolean('a_perlu_sk');
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
};
