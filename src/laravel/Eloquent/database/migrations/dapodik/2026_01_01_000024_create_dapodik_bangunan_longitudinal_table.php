<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\BangunanLongitudinal;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = BangunanLongitudinal::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_bangunan');
            $table->char('semester_id', 5);
            $table->primary(['id_bangunan', 'semester_id']);
            $table->decimal('kerusakan_id', 2, 0);
            $table->decimal('nilai_kerusakan', 6, 2);
            $table->decimal('rusak_pondasi', 6, 2)->nullable()->default(0);
            $table->string('ket_pondasi', 120)->nullable();
            $table->decimal('rusak_sloop_kolom_balok', 6, 2)->nullable()->default(0);
            $table->string('ket_sloop_kolom_balok', 120)->nullable();
            $table->decimal('rusak_plester_struktur', 6, 2)->nullable()->default(0);
            $table->string('ket_plester_struktur', 120)->nullable();
            $table->decimal('rusak_kudakuda_atap', 6, 2)->nullable()->default(0);
            $table->string('ket_kudakuda_atap', 120)->nullable();
            $table->decimal('rusak_kaso_atap', 6, 2)->nullable()->default(0);
            $table->string('ket_kaso_atap', 120)->nullable();
            $table->decimal('rusak_reng_atap', 6, 2)->nullable()->default(0);
            $table->string('ket_reng_atap', 120)->nullable();
            $table->decimal('rusak_tutup_atap', 6, 2)->nullable()->default(0);
            $table->string('ket_tutup_atap', 120)->nullable();
            $table->decimal('nilai_saat_ini', 20, 2)->nullable();
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
