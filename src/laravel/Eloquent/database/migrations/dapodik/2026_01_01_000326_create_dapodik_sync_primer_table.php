<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\SyncPrimer;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikSyncPrimerTable extends Migration
{
    protected $model = SyncPrimer::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->string('table_name', 30);
            $table->uuid('id_instalasi');
            $table->primary(['table_name', 'id_instalasi']);
            $table->smallInteger('id_thread');
            $table->string('sync_ket', 100)->nullable();
            $table->smallInteger('sync_status')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
