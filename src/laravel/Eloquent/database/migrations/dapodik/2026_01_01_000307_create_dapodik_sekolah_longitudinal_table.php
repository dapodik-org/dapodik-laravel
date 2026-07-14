<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\SekolahLongitudinal;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = SekolahLongitudinal::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('sekolah_id');
            $table->char('semester_id', 5);
            $table->primary(['sekolah_id', 'semester_id']);
            $table->decimal('waktu_penyelenggaraan_id', 1, 0);
            $table->char('kontinuitas_listrik', 1)->default('1');
            $table->decimal('jarak_listrik', 10, 0)->nullable();
            $table->decimal('wilayah_terpencil', 1, 0);
            $table->decimal('wilayah_perbatasan', 1, 0);
            $table->decimal('wilayah_transmigrasi', 1, 0);
            $table->decimal('wilayah_adat_terpencil', 1, 0);
            $table->decimal('wilayah_bencana_alam', 1, 0);
            $table->decimal('wilayah_bencana_sosial', 1, 0);
            $table->decimal('partisipasi_bos', 1, 0)->default(1);
            $table->smallInteger('sertifikasi_iso_id');
            $table->decimal('sumber_listrik_id', 2, 0);
            $table->decimal('daya_listrik', 6, 0);
            $table->smallInteger('akses_internet_id')->nullable();
            $table->smallInteger('akses_internet_2_id');
            $table->uuid('blob_id')->nullable();
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
