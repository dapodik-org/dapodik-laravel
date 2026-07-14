<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\AkreditasiProdi;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikAkreditasiProdiTable extends Migration
{
    protected $model = AkreditasiProdi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('akred_prodi_id')->primary();
            $table->decimal('akreditasi_id', 1, 0);
            $table->char('la_id', 5);
            $table->uuid('jurusan_sp_id');
            $table->string('no_sk_akred', 80);
            $table->date('tgl_sk_akred');
            $table->date('tgl_akhir_akred');
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
}
