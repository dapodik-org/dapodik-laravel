<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\ManAkses\LogOtorisasi;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikLogOtorisasiTable extends Migration
{
    protected $model = LogOtorisasi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('token_sesi')->primary();
            $table->uuid('id_role_pengguna');
            $table->timestamp('last_activity')->nullable();
            $table->timestamp('log_off')->nullable();
            $table->integer('a_time_out');
            $table->string('alamat_ip')->nullable();
            $table->boolean('a_sesi_aktif');
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
