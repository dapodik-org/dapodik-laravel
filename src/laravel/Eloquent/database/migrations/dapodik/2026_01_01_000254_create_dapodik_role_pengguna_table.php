<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\ManAkses\RolePengguna;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikRolePenggunaTable extends Migration
{
    protected $model = RolePengguna::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_role_pengguna')->primary();
            $table->uuid('sekolah_id')->nullable();
            $table->uuid('lembaga_id')->nullable();
            $table->uuid('yayasan_id')->nullable();
            $table->string('la_id', 1)->nullable();
            $table->uuid('dudi_id')->nullable();
            $table->integer('kode_lemb_sert')->nullable();
            $table->uuid('pengguna_id');
            $table->integer('peran_id');
            $table->string('sk_penugasan')->nullable();
            $table->date('tgl_sk_penugasan')->nullable();
            $table->boolean('approval_peran');
            $table->date('tgl_kadaluwarsa')->nullable();
            $table->timestamp('last_active')->nullable();
            $table->string('jenis_lembaga', 1);
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
