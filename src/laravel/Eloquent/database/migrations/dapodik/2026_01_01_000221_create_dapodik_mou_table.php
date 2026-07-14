<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Mou;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Mou::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('mou_id')->primary();
            $table->decimal('id_jns_ks', 6, 0);
            $table->uuid('dudi_id')->nullable();
            $table->uuid('sekolah_id');
            $table->string('nomor_mou', 80);
            $table->string('judul_mou', 80);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('nama_dudi', 100);
            $table->char('npwp_dudi', 15)->nullable();
            $table->string('nama_bidang_usaha', 40);
            $table->string('telp_kantor', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('contact_person', 100)->nullable();
            $table->string('telp_cp', 20)->nullable();
            $table->string('jabatan_cp', 40)->nullable();
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
