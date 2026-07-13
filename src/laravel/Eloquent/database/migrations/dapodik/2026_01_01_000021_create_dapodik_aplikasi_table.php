<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Aplikasi;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikAplikasiTable extends Migration
{
    protected $model = Aplikasi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_aplikasi')->primary();
            $table->string('nm_aplikasi');
            $table->string('ket_aplikasi')->nullable();
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
