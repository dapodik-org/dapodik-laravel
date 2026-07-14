<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisSertifikasi;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = JenisSertifikasi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('id_jenis_sertifikasi')->primary();
            $table->string('jenis_sertifikasi');
            $table->boolean('prof_guru');
            $table->boolean('kepala_sekolah');
            $table->boolean('laboran');
            $table->boolean('a_pd');
            $table->bigInteger('kebutuhan_khusus_id');
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
