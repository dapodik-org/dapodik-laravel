<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Frequency;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Frequency::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->integer('id_freq')->primary();
            $table->string('freq');
            $table->integer('interval');
            $table->string('time_unit', 1);
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
