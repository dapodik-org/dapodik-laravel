<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Nilai\MatevRapor;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = MatevRapor::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_evaluasi')->primary();
            $table->string('nm_mata_evaluasi');
            $table->boolean('a_dari_template');
            $table->integer('no_urut');
            $table->decimal('kkm_kognitif', 5, 2)->nullable();
            $table->decimal('kkm_psikomotorik', 5, 2)->nullable();
            $table->uuid('rombongan_belajar_id');
            $table->integer('mata_pelajaran_id');
            $table->uuid('pembelajaran_id')->nullable();
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
