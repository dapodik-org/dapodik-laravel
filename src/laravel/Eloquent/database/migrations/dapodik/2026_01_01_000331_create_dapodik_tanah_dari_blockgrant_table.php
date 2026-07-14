<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\TanahDariBlockgrant;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = TanahDariBlockgrant::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('blockgrant_id');
            $table->uuid('id_tanah');
            $table->primary(['blockgrant_id', 'id_tanah']);
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
