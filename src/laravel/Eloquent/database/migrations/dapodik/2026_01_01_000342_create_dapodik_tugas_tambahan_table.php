<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\TugasTambahan;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = TugasTambahan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('ptk_tugas_tambahan_id')->primary();
            $table->uuid('ptk_id');
            $table->uuid('id_ruang')->nullable();
            $table->decimal('jabatan_ptk_id', 5, 0);
            $table->uuid('sekolah_id');
            $table->decimal('jumlah_jam', 2, 0);
            $table->string('nomor_sk', 80);
            $table->date('tmt_tambahan');
            $table->date('tst_tambahan')->nullable();
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
