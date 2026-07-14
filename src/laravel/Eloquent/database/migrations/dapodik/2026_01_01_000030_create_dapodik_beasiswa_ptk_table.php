<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\BeasiswaPtk;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = BeasiswaPtk::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('beasiswa_ptk_id')->primary();
            $table->integer('jenis_beasiswa_id');
            $table->uuid('ptk_id');
            $table->string('keterangan', 200);
            $table->decimal('tahun_mulai', 4, 0);
            $table->decimal('tahun_akhir', 4, 0)->nullable();
            $table->decimal('masih_menerima', 1, 0)->default(1);
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
};
