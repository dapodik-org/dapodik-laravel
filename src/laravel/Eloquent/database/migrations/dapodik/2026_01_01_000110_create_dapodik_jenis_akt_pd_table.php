<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisAktPd;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisAktPdTable extends Migration
{
    protected $model = JenisAktPd::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('id_jns_akt_pd')->primary();
            $table->string('nm_jns_akt_pd');
            $table->string('ket_jns_akt_pd')->nullable();
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
