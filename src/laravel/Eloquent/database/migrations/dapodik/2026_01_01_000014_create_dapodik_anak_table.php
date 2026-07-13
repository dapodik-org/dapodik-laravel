<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Anak;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikAnakTable extends Migration
{
    protected $model = Anak::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('anak_id')->primary();
            $table->uuid('ptk_id');
            $table->decimal('status_anak_id', 1, 0);
            $table->decimal('jenjang_pendidikan_id', 2, 0);
            $table->char('nik', 16)->nullable();
            $table->char('nisn', 10)->nullable();
            $table->string('nama', 100);
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir', 32)->nullable();
            $table->date('tanggal_lahir');
            $table->integer('tahun_masuk')->nullable();
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
