<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ruang;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Ruang::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_ruang')->primary();
            $table->integer('jenis_prasarana_id');
            $table->uuid('sekolah_id');
            $table->uuid('parent_id_ruang')->nullable();
            $table->uuid('id_bangunan');
            $table->char('asal_data', 1)->default('1');
            $table->string('kd_ruang', 10);
            $table->string('nm_ruang', 100);
            $table->decimal('lantai', 3, 0)->default(1);
            $table->float('panjang')->nullable();
            $table->float('lebar')->nullable();
            $table->string('reg_pras', 16)->nullable();
            $table->decimal('kapasitas', 5, 0)->nullable();
            $table->float('luas_ruang')->nullable();
            $table->decimal('luas_plester_m2', 7, 1)->nullable();
            $table->decimal('luas_plafon_m2', 7, 1)->nullable();
            $table->decimal('luas_dinding_m2', 7, 1)->nullable();
            $table->decimal('luas_daun_jendela_m2', 7, 1)->nullable();
            $table->decimal('luas_daun_pintu_m2', 7, 1)->nullable();
            $table->decimal('panj_kusen_m', 7, 1)->nullable();
            $table->decimal('luas_tutup_lantai_m2', 7, 1)->nullable();
            $table->decimal('panj_inst_listrik_m', 7, 1)->nullable();
            $table->decimal('jml_inst_listrik', 4, 0)->nullable();
            $table->decimal('panj_inst_air_m', 7, 1)->nullable();
            $table->decimal('jml_inst_air', 4, 0)->nullable();
            $table->decimal('panj_drainase_m', 7, 1)->nullable();
            $table->decimal('luas_finish_struktur_m2', 7, 1)->nullable();
            $table->decimal('luas_finish_plafon_m2', 7, 1)->nullable();
            $table->decimal('luas_finish_dinding_m2', 7, 1)->nullable();
            $table->decimal('luas_finish_kpj_m2', 7, 1)->nullable();
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
