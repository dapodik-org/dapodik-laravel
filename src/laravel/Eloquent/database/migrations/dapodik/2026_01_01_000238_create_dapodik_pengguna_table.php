<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\ManAkses\Pengguna;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Pengguna::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('pengguna_id')->primary();
            $table->uuid('sekolah_id')->nullable();
            $table->uuid('lembaga_id')->nullable();
            $table->uuid('yayasan_id')->nullable();
            $table->string('la_id', 1)->nullable();
            $table->uuid('dudi_id')->nullable();
            $table->integer('kode_lemb_sert')->nullable();
            $table->uuid('peserta_didik_id')->nullable();
            $table->string('username');
            $table->boolean('a_bot');
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jenis_kelamin', 1);
            $table->string('nip_nim')->nullable();
            $table->string('jabatan_lembaga')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kode_wilayah', 8);
            $table->string('no_telepon')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('user_telegram')->nullable();
            $table->boolean('approval_pengguna');
            $table->boolean('aktif')->default(true);
            $table->string('password');
            $table->string('password_lama')->nullable();
            $table->date('tgl_ganti_pwd')->nullable();
            $table->uuid('id_sdm_pengguna')->nullable();
            $table->uuid('id_pd_pengguna')->nullable();
            $table->string('token_reg', 1)->nullable();
            $table->string('jabatan')->nullable();
            $table->uuid('ptk_id')->nullable();
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
