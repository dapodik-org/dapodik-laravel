<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RegistrasiPesertaDidik;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = RegistrasiPesertaDidik::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('registrasi_id')->primary();
            $table->uuid('jurusan_sp_id')->nullable();
            $table->uuid('peserta_didik_id');
            $table->uuid('sekolah_id');
            $table->decimal('jenis_pendaftaran_id', 1, 0);
            $table->string('nipd', 18)->nullable();
            $table->date('tanggal_masuk_sekolah');
            $table->char('jenis_keluar_id', 1)->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('keterangan', 128)->nullable();
            $table->char('no_skhun', 22)->nullable();
            $table->char('no_peserta_ujian', 22)->nullable();
            $table->string('no_seri_ijazah', 80)->nullable();
            $table->decimal('a_pernah_paud', 1, 0)->default(0);
            $table->decimal('a_pernah_tk', 1, 0)->default(0);
            $table->string('sekolah_asal', 100)->nullable();
            $table->decimal('id_hobby', 5, 0);
            $table->decimal('id_cita', 5, 0);
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
