<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Eloquent\SyncStatus;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = SyncStatus::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->autoIncrement();
            $table->string('target_table')->unique();
            $table->bigInteger('records_synced')->default(0);
            $table->timestamp('last_sync')->nullable();
            $table->string('source_hash', 64)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->dropTable();
    }
};
