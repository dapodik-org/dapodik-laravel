<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\TetanggaKabkota;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikTetanggaKabkotaTable extends Migration
{
    protected $model = TetanggaKabkota::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->char('kode_wilayah1', 8);
            $table->char('kode_wilayah2', 8);
            $table->primary(['kode_wilayah1', 'kode_wilayah2']);
            $table->timestamp('last_sync')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->softDeletes('expired_date');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
