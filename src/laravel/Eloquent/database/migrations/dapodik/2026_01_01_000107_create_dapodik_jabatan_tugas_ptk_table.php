<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JabatanTugasPtk;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJabatanTugasPtkTable extends Migration
{
    protected $model = JabatanTugasPtk::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('jabatan_ptk_id')->primary();
            $table->string('nama');
            $table->boolean('jabatan_utama');
            $table->boolean('tugas_tambahan_guru');
            $table->decimal('jumlah_jam_diakui', 2, 0)->nullable();
            $table->boolean('harus_refer_unit_org')->default(false);
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
