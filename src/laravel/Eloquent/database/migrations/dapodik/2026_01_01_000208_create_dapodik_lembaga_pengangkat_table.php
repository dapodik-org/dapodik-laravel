<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\LembagaPengangkat;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikLembagaPengangkatTable extends Migration
{
    protected $model = LembagaPengangkat::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('lembaga_pengangkat_id')->primary();
            $table->string('nama');
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
