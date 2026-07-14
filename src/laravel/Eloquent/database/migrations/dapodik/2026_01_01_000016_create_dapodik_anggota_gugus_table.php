<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\AnggotaGugus;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = AnggotaGugus::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('gugus_id');
            $table->uuid('sekolah_id');
            $table->primary(['gugus_id', 'sekolah_id']);
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
