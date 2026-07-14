<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\PesertaDidikBaru;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = PesertaDidikBaru::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('pdb_id')->primary();
            $table->uuid('sekolah_id');
            $table->decimal('tahun_ajaran_id', 4, 0);
            $table->string('nama_pd', 100);
            $table->char('jenis_kelamin', 1);
            $table->char('nisn', 10)->nullable();
            $table->char('nik', 16)->nullable();
            $table->string('tempat_lahir', 32)->nullable();
            $table->date('tanggal_lahir');
            $table->string('nama_ibu_kandung', 100);
            $table->decimal('jenis_pendaftaran_id', 1, 0);
            $table->decimal('sudah_diproses', 1, 0)->default(0);
            $table->decimal('berhasil_diproses', 1, 0)->default(0);
            $table->uuid('peserta_didik_id')->nullable();
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
};
