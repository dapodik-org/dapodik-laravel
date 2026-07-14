<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\KitasPtk;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikKitasPtkTable extends Migration
{
    protected $model = KitasPtk::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->string('no_kitas', 20);
            $table->uuid('ptk_id');
            $table->date('tmt_kitas');
            $table->date('tst_kitas');
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
