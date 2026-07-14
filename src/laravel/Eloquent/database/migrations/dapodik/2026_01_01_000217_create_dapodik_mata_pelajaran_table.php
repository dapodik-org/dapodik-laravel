<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\MataPelajaran;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = MataPelajaran::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('mata_pelajaran_id')->primary();
            $table->string('nama');
            $table->boolean('pilihan_sekolah');
            $table->boolean('pilihan_buku');
            $table->boolean('pilihan_kepengawasan');
            $table->boolean('pilihan_evaluasi');
            $table->char('jurusan_id', 25)->nullable();
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
