<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Listrik;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Listrik::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('listrik_id')->primary();
            $table->uuid('sekolah_id');
            $table->decimal('sumber_listrik_id', 2, 0);
            $table->decimal('daya', 6, 0);
            $table->char('kontinuitas_listrik', 1)->default('1');
            $table->string('id_pelanggan', 12)->nullable();
            $table->string('nomor_meter', 20)->nullable();
            $table->char('jenis_meter', 3)->nullable();
            $table->string('status_sambungan', 20);
            $table->decimal('utama', 1, 0);
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
