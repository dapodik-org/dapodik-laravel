<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\VersiDb;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixPrimaryKeyVersiDb extends Migration
{
    protected $model = VersiDb::class;

    public function up()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->timestamp('tanggal_update')->nullable()->change();
            $table->primary('versi_id');
        });
    }

    public function down()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->dropPrimary();
            $table->timestamp('tanggal_update')->nullable(false)->change();
        });
    }
}
