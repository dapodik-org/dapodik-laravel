<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPendaftaran;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = JenisPendaftaran::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jenis_pendaftaran_id')->primary();
            $table->string('nama');
            $table->boolean('daftar_sekolah');
            $table->boolean('daftar_rombel');
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
