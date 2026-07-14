<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\TahunAjaran;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = TahunAjaran::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('tahun_ajaran_id')->primary();
            $table->string('nama');
            $table->boolean('periode_aktif');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
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
