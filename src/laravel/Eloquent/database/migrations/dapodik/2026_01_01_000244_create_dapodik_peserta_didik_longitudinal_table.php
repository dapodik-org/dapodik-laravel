<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\PesertaDidikLongitudinal;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPesertaDidikLongitudinalTable extends Migration
{
    protected $model = PesertaDidikLongitudinal::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('peserta_didik_id');
            $table->char('semester_id', 5);
            $table->primary(['peserta_didik_id', 'semester_id']);
            $table->decimal('tinggi_badan', 3, 0);
            $table->decimal('berat_badan', 3, 0);
            $table->decimal('lingkar_kepala', 3, 0)->nullable();
            $table->decimal('jarak_rumah_ke_sekolah', 1, 0);
            $table->decimal('jarak_rumah_ke_sekolah_km', 3, 0)->nullable();
            $table->decimal('waktu_tempuh_ke_sekolah', 1, 0);
            $table->decimal('menit_tempuh_ke_sekolah', 3, 0)->nullable();
            $table->decimal('jumlah_saudara_kandung', 2, 0);
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
