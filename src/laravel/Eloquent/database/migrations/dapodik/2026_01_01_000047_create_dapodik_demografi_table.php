<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Demografi;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikDemografiTable extends Migration
{
    protected $model = Demografi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('demografi_id')->primary();
            $table->char('kode_wilayah', 8);
            $table->decimal('tahun_ajaran_id', 4, 0);
            $table->bigInteger('usia_5');
            $table->bigInteger('usia_7');
            $table->bigInteger('usia_13');
            $table->bigInteger('usia_16');
            $table->bigInteger('usia_18');
            $table->bigInteger('jumlah_penduduk');
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
