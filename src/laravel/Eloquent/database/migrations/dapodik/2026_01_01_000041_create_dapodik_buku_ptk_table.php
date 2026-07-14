<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\BukuPtk;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikBukuPtkTable extends Migration
{
    protected $model = BukuPtk::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('buku_id')->primary();
            $table->uuid('ptk_id');
            $table->string('judul_buku', 200);
            $table->decimal('tahun', 4, 0);
            $table->string('penerbit', 30)->nullable();
            $table->string('isbn', 20)->nullable();
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
