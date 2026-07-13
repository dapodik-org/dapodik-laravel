<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Blockgrant;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikBlockgrantTable extends Migration
{
    protected $model = Blockgrant::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('blockgrant_id')->primary();
            $table->uuid('sekolah_id');
            $table->string('nama', 150);
            $table->decimal('tahun', 4, 0);
            $table->integer('jenis_bantuan_id');
            $table->decimal('sumber_dana_id', 3, 0);
            $table->decimal('besar_bantuan', 15, 0);
            $table->decimal('dana_pendamping', 15, 0);
            $table->string('peruntukan_dana', 50)->nullable();
            $table->char('asal_data', 1)->default('1');
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
