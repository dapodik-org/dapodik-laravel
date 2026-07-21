<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pustaka\Biblio;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixNullableBiblio extends Migration
{
    protected $model = Biblio::class;

    public function up()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->string('id_gmd')->nullable()->change();
            $table->string('collations')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->string('id_gmd')->nullable(false)->change();
            $table->string('collations')->nullable(false)->change();
        });
    }
}
