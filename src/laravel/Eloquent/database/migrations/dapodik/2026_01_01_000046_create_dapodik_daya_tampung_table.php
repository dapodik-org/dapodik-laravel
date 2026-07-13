<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\DayaTampung;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikDayaTampungTable extends Migration
{
    protected $model = DayaTampung::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('daya_tampung_id')->primary();
            $table->uuid('sekolah_id');
            $table->uuid('jurusan_sp_id')->nullable();
            $table->decimal('tingkat_pendidikan_id', 2, 0);
            $table->decimal('tahun_ajaran_id', 4, 0);
            $table->smallInteger('jumlah_rombel');
            $table->smallInteger('jumlah_siswa_min')->nullable();
            $table->smallInteger('jumlah_siswa_max');
            $table->char('jenis_validasi', 1)->default('E');
            $table->decimal('is_lock', 1, 0);
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
