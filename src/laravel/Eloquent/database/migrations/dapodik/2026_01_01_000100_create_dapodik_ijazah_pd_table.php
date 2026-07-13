<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\IjazahPd;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikIjazahPdTable extends Migration
{
    protected $model = IjazahPd::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('ijazah_id')->primary();
            $table->uuid('registrasi_id');
            $table->decimal('jenis_ijazah_id', 2, 0);
            $table->string('nomor', 30);
            $table->string('penandatangan', 100)->nullable();
            $table->date('tanggal_ttd')->nullable();
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
