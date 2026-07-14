<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RwyStruktural;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikRwyStrukturalTable extends Migration
{
    protected $model = RwyStruktural::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('riwayat_struktural_id')->primary();
            $table->uuid('ptk_id');
            $table->decimal('jabatan_ptk_id', 5, 0);
            $table->string('sk_struktural', 80);
            $table->date('tmt_jabatan');
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
