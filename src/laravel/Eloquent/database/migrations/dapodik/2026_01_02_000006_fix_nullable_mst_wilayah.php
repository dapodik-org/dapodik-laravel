<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\MstWilayah;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixNullableMstWilayah extends Migration
{
    protected $model = MstWilayah::class;

    public function up()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->char('negara_id', 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->char('negara_id', 2)->nullable(false)->change();
        });
    }
}
