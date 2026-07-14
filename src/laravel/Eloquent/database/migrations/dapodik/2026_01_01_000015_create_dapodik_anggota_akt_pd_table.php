<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\AnggotaAktPd;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = AnggotaAktPd::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_ang_akt_pd')->primary();
            $table->uuid('id_akt_pd');
            $table->uuid('registrasi_id');
            $table->string('nm_pd', 100);
            $table->string('nipd', 24);
            $table->char('jns_peran_pd', 1)->default('3');
            $table->uuid('updater_id');
            $table->timestamp('last_sync')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->softDeletes('soft_delete');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
};
