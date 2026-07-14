<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Nilai\NilaiSmt;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikNilaiSmtTable extends Migration
{
    protected $model = NilaiSmt::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('anggota_rombel_id')->primary();
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
