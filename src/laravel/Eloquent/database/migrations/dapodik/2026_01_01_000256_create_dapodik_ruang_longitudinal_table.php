<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RuangLongitudinal;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikRuangLongitudinalTable extends Migration
{
    protected $model = RuangLongitudinal::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_ruang');
            $table->char('semester_id', 5);
            $table->primary(['id_ruang', 'semester_id']);
            $table->decimal('kerusakan_id', 2, 0);
            $table->decimal('nilai_kerusakan', 6, 2);
            $table->decimal('rusak_lisplang_talang', 6, 2)->nullable()->default(0);
            $table->string('ket_lisplang_talang', 120)->nullable();
            $table->decimal('rusak_rangka_plafon', 6, 2)->nullable()->default(0);
            $table->string('ket_rangka_plafon', 120)->nullable();
            $table->decimal('rusak_tutup_plafon', 6, 2)->nullable()->default(0);
            $table->string('ket_tutup_plafon', 120)->nullable();
            $table->decimal('rusak_bata_dinding', 6, 2)->nullable()->default(0);
            $table->string('ket_bata_dinding', 120)->nullable();
            $table->decimal('rusak_plester_dinding', 6, 2)->nullable()->default(0);
            $table->string('ket_plester_dinding', 120)->nullable();
            $table->decimal('rusak_daun_jendela', 6, 2)->nullable()->default(0);
            $table->string('ket_daun_jendela', 120)->nullable();
            $table->decimal('rusak_daun_pintu', 6, 2)->nullable()->default(0);
            $table->string('ket_daun_pintu', 120)->nullable();
            $table->decimal('rusak_kusen', 6, 2)->nullable()->default(0);
            $table->string('ket_kusen', 120)->nullable();
            $table->decimal('rusak_tutup_lantai', 6, 2)->nullable()->default(0);
            $table->string('ket_penutup_lantai', 120)->nullable();
            $table->decimal('rusak_inst_listrik', 6, 2)->nullable()->default(0);
            $table->string('ket_inst_listrik', 120)->nullable();
            $table->decimal('rusak_inst_air', 6, 2)->nullable()->default(0);
            $table->string('ket_inst_air', 120)->nullable();
            $table->decimal('rusak_drainase', 6, 2)->nullable()->default(0);
            $table->string('ket_drainase', 120)->nullable();
            $table->decimal('rusak_finish_struktur', 6, 2)->nullable()->default(0);
            $table->string('ket_finish_struktur', 120)->nullable();
            $table->decimal('rusak_finish_plafon', 6, 2)->nullable()->default(0);
            $table->string('ket_finish_plafon', 120)->nullable();
            $table->decimal('rusak_finish_dinding', 6, 2)->nullable()->default(0);
            $table->string('ket_finish_dinding', 120)->nullable();
            $table->decimal('rusak_finish_kpj', 6, 2)->nullable()->default(0);
            $table->string('ket_finish_kpj', 120)->nullable();
            $table->decimal('berfungsi', 1, 0)->default(1);
            $table->uuid('blob_id')->nullable();
            $table->char('asal_data', 1)->default('1');
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
