<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\AktivitasKepanitiaan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikAktivitasKepanitiaanTable extends Migration
{
    protected $model = AktivitasKepanitiaan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_akt_pan')->primary();
            $table->uuid('id_panitia');
            $table->char('semester_id', 5);
            $table->decimal('id_jns_akt_pan', 4, 0);
            $table->decimal('frek_akt_pan', 4, 0);
            $table->string('ket_akt_pan', 300)->nullable();
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
}
