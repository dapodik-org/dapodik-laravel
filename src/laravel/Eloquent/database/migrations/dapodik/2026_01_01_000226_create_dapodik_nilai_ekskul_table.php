<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Nilai\NilaiEkskul;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikNilaiEkskulTable extends Migration
{
    protected $model = NilaiEkskul::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_nilai_x')->primary();
            $table->uuid('id_kelas_ekskul');
            $table->uuid('anggota_rombel_id');
            $table->decimal('nilai_angka', 5, 2);
            $table->string('nilai_huruf')->nullable();
            $table->string('ket')->nullable();
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
