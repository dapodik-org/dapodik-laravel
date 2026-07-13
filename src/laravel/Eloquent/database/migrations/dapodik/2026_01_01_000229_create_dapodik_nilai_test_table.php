<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\NilaiTest;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikNilaiTestTable extends Migration
{
    protected $model = NilaiTest::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('nilai_test_id')->primary();
            $table->decimal('jenis_test_id', 3, 0);
            $table->uuid('ptk_id');
            $table->string('nama', 50);
            $table->string('penyelenggara', 100);
            $table->decimal('tahun', 4, 0);
            $table->decimal('skor', 6, 2);
            $table->decimal('skor1', 6, 2)->nullable();
            $table->decimal('skor2', 6, 2)->nullable();
            $table->decimal('skor3', 6, 2)->nullable();
            $table->decimal('skor4', 6, 2)->nullable();
            $table->decimal('skor5', 6, 2)->nullable();
            $table->string('nomor_peserta', 12)->nullable();
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
