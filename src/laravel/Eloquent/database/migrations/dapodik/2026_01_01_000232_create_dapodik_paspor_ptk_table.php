<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\PasporPtk;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPasporPtkTable extends Migration
{
    protected $model = PasporPtk::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->string('no_paspor', 20);
            $table->uuid('ptk_id');
            $table->string('tempat_terbit', 100);
            $table->date('tmt_paspor');
            $table->date('tst_paspor');
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
