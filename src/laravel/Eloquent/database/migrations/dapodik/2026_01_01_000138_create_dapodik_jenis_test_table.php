<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisTest;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisTestTable extends Migration
{
    protected $model = JenisTest::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jenis_test_id')->primary();
            $table->string('jenis_test');
            $table->string('keterangan')->nullable();
            $table->decimal('nilai_maks', 6, 2);
            $table->string('ket_skor1')->nullable();
            $table->string('ket_skor2')->nullable();
            $table->string('ket_skor3')->nullable();
            $table->string('ket_skor4')->nullable();
            $table->string('ket_skor5')->nullable();
            $table->timestamp('last_sync')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->softDeletes('expired_date');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
