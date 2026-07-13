<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Nilai\NilaiRapor;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikNilaiRaporTable extends Migration
{
    protected $model = NilaiRapor::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('nilai_id')->primary();
            $table->uuid('id_evaluasi');
            $table->uuid('anggota_rombel_id');
            $table->decimal('nilai_kognitif_angka', 5, 2);
            $table->string('nilai_kognitif_huruf')->nullable();
            $table->string('ket_kognitif')->nullable();
            $table->decimal('nilai_psim_angka', 5, 2)->nullable();
            $table->string('nilai_psim_huruf')->nullable();
            $table->string('ket_psim')->nullable();
            $table->decimal('nilai_afektif_angka', 5, 2)->nullable();
            $table->string('nilai_afektif_huruf')->nullable();
            $table->string('ket_afektif')->nullable();
            $table->decimal('nilai_afektif2_angka', 5, 2)->nullable();
            $table->string('nilai_afektif2_huruf')->nullable();
            $table->string('ket_afektif2')->nullable();
            $table->boolean('a_beku');
            $table->integer('rapor_ke')->nullable();
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
