<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Jadwal;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Jadwal::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('sekolah_id');
            $table->char('semester_id', 5);
            $table->uuid('id_ruang');
            $table->primary(['sekolah_id', 'semester_id', 'id_ruang']);
            $table->decimal('hari', 1, 0);
            $table->uuid('bel_ke_01')->nullable();
            $table->uuid('bel_ke_02')->nullable();
            $table->uuid('bel_ke_03')->nullable();
            $table->uuid('bel_ke_04')->nullable();
            $table->uuid('bel_ke_05')->nullable();
            $table->uuid('bel_ke_06')->nullable();
            $table->uuid('bel_ke_07')->nullable();
            $table->uuid('bel_ke_08')->nullable();
            $table->uuid('bel_ke_09')->nullable();
            $table->uuid('bel_ke_10')->nullable();
            $table->uuid('bel_ke_11')->nullable();
            $table->uuid('bel_ke_12')->nullable();
            $table->uuid('bel_ke_13')->nullable();
            $table->uuid('bel_ke_14')->nullable();
            $table->uuid('bel_ke_15')->nullable();
            $table->uuid('bel_ke_16')->nullable();
            $table->uuid('bel_ke_17')->nullable();
            $table->uuid('bel_ke_18')->nullable();
            $table->uuid('bel_ke_19')->nullable();
            $table->uuid('bel_ke_20')->nullable();
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
