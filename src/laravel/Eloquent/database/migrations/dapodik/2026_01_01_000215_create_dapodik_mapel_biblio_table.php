<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pustaka\MapelBiblio;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikMapelBiblioTable extends Migration
{
    protected $model = MapelBiblio::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_biblio');
            $table->integer('mata_pelajaran_id');
            $table->primary(['id_biblio', 'mata_pelajaran_id']);
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
