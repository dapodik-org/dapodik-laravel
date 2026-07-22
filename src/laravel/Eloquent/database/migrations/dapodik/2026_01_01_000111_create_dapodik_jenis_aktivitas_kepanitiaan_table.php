<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisAktivitasKepanitiaan;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = JenisAktivitasKepanitiaan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('id_jns_akt_pan')->primary();
            $table->string('nm_jns_akt_pan');
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
};
