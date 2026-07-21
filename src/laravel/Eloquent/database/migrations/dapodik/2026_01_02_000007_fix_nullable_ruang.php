<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ruang;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixNullableRuang extends Migration
{
    protected $model = Ruang::class;

    public function up()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->integer('jenis_prasarana_id')->nullable()->change();
            $table->uuid('id_bangunan')->nullable()->change();
            $table->uuid('updater_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->integer('jenis_prasarana_id')->nullable(false)->change();
            $table->uuid('id_bangunan')->nullable(false)->change();
            $table->uuid('updater_id')->nullable(false)->change();
        });
    }
}
