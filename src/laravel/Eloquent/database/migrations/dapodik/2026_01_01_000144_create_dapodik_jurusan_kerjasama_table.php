<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\JurusanKerjasama;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = JurusanKerjasama::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('mou_id');
            $table->uuid('jurusan_sp_id');
            $table->primary(['mou_id', 'jurusan_sp_id']);
            $table->uuid('updater_id');
            $table->timestamp('last_sync')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->softDeletes('soft_delete');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
};
