<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKs;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisKsTable extends Migration
{
    protected $model = JenisKs::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('id_jns_ks')->primary();
            $table->string('nm_jns_ks');
            $table->string('ket_jns_ks')->nullable();
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
