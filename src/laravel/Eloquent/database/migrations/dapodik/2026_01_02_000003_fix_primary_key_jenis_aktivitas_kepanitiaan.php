<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisAktivitasKepanitiaan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixPrimaryKeyJenisAktivitasKepanitiaan extends Migration
{
    protected $model = JenisAktivitasKepanitiaan::class;

    public function up()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->primary('id_jns_akt_pan');
        });
    }

    public function down()
    {
        Schema::connection($this->getConnection())->table($this->getTable(), function(Blueprint $table) {
            $table->dropPrimary();
        });
    }
}
