<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\GuruSasaranPengawas;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = GuruSasaranPengawas::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('pengawas_terdaftar_id');
            $table->uuid('ptk_terdaftar_id');
            $table->primary(['pengawas_terdaftar_id', 'ptk_terdaftar_id']);
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
