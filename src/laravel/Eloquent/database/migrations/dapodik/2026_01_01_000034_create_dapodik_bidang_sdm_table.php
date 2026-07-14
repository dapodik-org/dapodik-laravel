<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\BidangSdm;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikBidangSdmTable extends Migration
{
    protected $model = BidangSdm::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('ptk_id');
            $table->integer('bidang_studi_id');
            $table->primary(['ptk_id', 'bidang_studi_id']);
            $table->decimal('urutan', 1, 0);
            $table->char('asal_data', 1)->default('1');
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
}
