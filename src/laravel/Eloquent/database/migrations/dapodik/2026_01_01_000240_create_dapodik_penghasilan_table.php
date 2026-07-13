<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\Penghasilan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPenghasilanTable extends Migration
{
    protected $model = Penghasilan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('penghasilan_id')->primary();
            $table->string('nama');
            $table->bigInteger('batas_bawah');
            $table->bigInteger('batas_atas');
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
