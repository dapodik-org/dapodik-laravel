<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RiwayatGajiBerkala;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = RiwayatGajiBerkala::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('riwayat_gaji_berkala_id')->primary();
            $table->uuid('ptk_id');
            $table->decimal('pangkat_golongan_id', 2, 0);
            $table->string('nomor_sk', 80);
            $table->date('tanggal_sk');
            $table->date('tmt_kgb');
            $table->decimal('masa_kerja_tahun', 2, 0);
            $table->decimal('masa_kerja_bulan', 2, 0);
            $table->decimal('gaji_pokok', 9, 0)->nullable();
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
