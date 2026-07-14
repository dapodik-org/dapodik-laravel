<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Tunjangan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikTunjanganTable extends Migration
{
    protected $model = Tunjangan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('tunjangan_id')->primary();
            $table->uuid('ptk_id');
            $table->integer('jenis_tunjangan_id')->nullable();
            $table->string('nama', 50);
            $table->string('instansi', 100)->nullable();
            $table->string('sk_tunjangan', 80)->nullable();
            $table->date('tgl_sk_tunjangan')->nullable();
            $table->char('semester_id', 5)->nullable();
            $table->string('sumber_dana', 30)->nullable();
            $table->decimal('dari_tahun', 4, 0);
            $table->decimal('sampai_tahun', 4, 0)->nullable();
            $table->decimal('nominal', 16, 2);
            $table->integer('status')->nullable();
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
