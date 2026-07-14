<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\TanahLongitudinal;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = TanahLongitudinal::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_tanah');
            $table->decimal('tahun_ajaran_id', 4, 0);
            $table->primary(['id_tanah', 'tahun_ajaran_id']);
            $table->decimal('njop', 20, 2)->nullable();
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
