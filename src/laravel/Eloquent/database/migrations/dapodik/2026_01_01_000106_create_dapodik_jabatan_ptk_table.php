<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JabatanPtk;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJabatanPtkTable extends Migration
{
    protected $model = JabatanPtk::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('jabatan_ptk_id')->primary();
            $table->bigInteger('jenis_ptk_id');
            $table->string('jabatan_ptk');
            $table->string('jabatan_kode')->nullable();
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
