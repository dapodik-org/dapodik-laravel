<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKeluar;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = JenisKeluar::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->char('jenis_keluar_id', 1)->primary();
            $table->string('ket_keluar');
            $table->boolean('keluar_pd');
            $table->boolean('keluar_ptk');
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
};
