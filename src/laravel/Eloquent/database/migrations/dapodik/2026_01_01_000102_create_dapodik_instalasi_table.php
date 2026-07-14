<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Instalasi;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikInstalasiTable extends Migration
{
    protected $model = Instalasi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_instalasi')->primary();
            $table->char('kode_wilayah', 8)->nullable();
            $table->uuid('sekolah_id')->nullable();
            $table->char('jns_instalasi', 1)->default('1');
            $table->decimal('a_link_aktif', 1, 0)->default(1);
            $table->string('ket_link', 100)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
