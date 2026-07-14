<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\BimbingPd;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikBimbingPdTable extends Migration
{
    protected $model = BimbingPd::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_bimb_pd')->primary();
            $table->uuid('id_akt_pd');
            $table->uuid('ptk_id');
            $table->decimal('urutan_pembimbing', 1, 0);
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
