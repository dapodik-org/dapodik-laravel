<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Kesejahteraan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikKesejahteraanTable extends Migration
{
    protected $model = Kesejahteraan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('kesejahteraan_id')->primary();
            $table->uuid('ptk_id');
            $table->integer('jenis_kesejahteraan_id');
            $table->string('nama', 50);
            $table->string('penyelenggara', 100);
            $table->decimal('dari_tahun', 4, 0);
            $table->decimal('sampai_tahun', 4, 0)->nullable();
            $table->integer('status')->nullable();
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
