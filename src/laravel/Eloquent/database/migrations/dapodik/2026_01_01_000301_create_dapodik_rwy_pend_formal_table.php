<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RwyPendFormal;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikRwyPendFormalTable extends Migration
{
    protected $model = RwyPendFormal::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('riwayat_pendidikan_formal_id')->primary();
            $table->integer('bidang_studi_id');
            $table->decimal('jenjang_pendidikan_id', 2, 0);
            $table->integer('gelar_akademik_id')->nullable();
            $table->uuid('ptk_id');
            $table->string('satuan_pendidikan_formal', 100);
            $table->string('fakultas', 200)->nullable();
            $table->decimal('kependidikan', 1, 0);
            $table->decimal('tahun_masuk', 4, 0);
            $table->decimal('tahun_lulus', 4, 0)->nullable();
            $table->string('nim', 50);
            $table->decimal('status_kuliah', 1, 0);
            $table->decimal('semester', 2, 0)->nullable();
            $table->decimal('ipk', 5, 2);
            $table->uuid('prodi')->nullable();
            $table->uuid('id_reg_pd')->nullable();
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
