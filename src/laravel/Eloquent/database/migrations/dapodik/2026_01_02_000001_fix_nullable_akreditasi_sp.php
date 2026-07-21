<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\AkreditasiSp;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixNullableAkreditasiSp extends Migration
{
    protected $model = AkreditasiSp::class;

    public function up()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->date('akred_sp_tst')->nullable()->change();
            $table->uuid('updater_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->date('akred_sp_tst')->nullable(false)->change();
            $table->uuid('updater_id')->nullable(false)->change();
        });
    }
}
