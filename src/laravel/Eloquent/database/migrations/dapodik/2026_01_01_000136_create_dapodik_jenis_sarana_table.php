<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisSarana;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = JenisSarana::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jenis_sarana_id')->primary();
            $table->string('nama');
            $table->string('kelompok')->nullable();
            $table->boolean('perlu_penempatan');
            $table->string('keterangan')->nullable();
            $table->boolean('a_alat')->default(false);
            $table->boolean('a_angkutan')->default(false);
            $table->decimal('spm_qty_min_per_siswa', 3, 1)->default(-1);
            $table->decimal('spm_qty_min_per_sekolah', 4, 0)->default(-1);
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
