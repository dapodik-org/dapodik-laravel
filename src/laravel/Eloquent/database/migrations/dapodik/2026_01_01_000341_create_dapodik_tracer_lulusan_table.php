<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\TracerLulusan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikTracerLulusanTable extends Migration
{
    protected $model = TracerLulusan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_tracer')->primary();
            $table->integer('penghasilan_id')->nullable();
            $table->uuid('registrasi_id');
            $table->date('tgl_entry');
            $table->char('akt_setelah_lulus', 1);
            $table->string('nm_inst_perusahaan', 100)->nullable();
            $table->string('nm_sp', 100)->nullable();
            $table->string('nm_prodi', 100)->nullable();
            $table->string('ket_tracer', 250)->nullable();
            $table->integer('pekerjaan_id')->nullable();
            $table->uuid('dudi_id')->nullable();
            $table->char('bidang_usaha_id', 10)->nullable();
            $table->uuid('id_prodi')->nullable();
            $table->char('stat_tracer', 1);
            $table->char('ikatan_kerja', 1)->default('*');
            $table->decimal('a_sesuai_kompetensi', 1, 0)->nullable();
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
