<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Menu;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikMenuTable extends Migration
{
    protected $model = Menu::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_menu')->primary();
            $table->uuid('men_id_menu')->nullable();
            $table->uuid('id_aplikasi');
            $table->string('nm_menu');
            $table->string('nm_file')->nullable();
            $table->integer('level_menu')->nullable();
            $table->integer('urutan_menu');
            $table->boolean('a_aktif');
            $table->boolean('a_tampil');
            $table->string('icon')->nullable();
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
