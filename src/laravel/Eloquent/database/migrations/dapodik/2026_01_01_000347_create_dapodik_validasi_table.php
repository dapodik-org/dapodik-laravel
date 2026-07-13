<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Validasi;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikValidasiTable extends Migration
{
    protected $model = Validasi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('sekolah_id');
            $table->integer('no_urut')->nullable();
            $table->uuid('id')->nullable();
            $table->string('jenis_validasi', 100);
            $table->string('table_name', 100);
            $table->integer('tipe')->nullable()->default(1);
            $table->string('keterangan', 255)->nullable()->default('1');
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
