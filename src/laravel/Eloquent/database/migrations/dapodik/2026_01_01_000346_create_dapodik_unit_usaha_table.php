<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\UnitUsaha;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikUnitUsahaTable extends Migration
{
    protected $model = UnitUsaha::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('unit_usaha_id')->primary();
            $table->char('kelompok_usaha_id', 8);
            $table->uuid('sekolah_id');
            $table->string('nama_unit_usaha', 100);
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
