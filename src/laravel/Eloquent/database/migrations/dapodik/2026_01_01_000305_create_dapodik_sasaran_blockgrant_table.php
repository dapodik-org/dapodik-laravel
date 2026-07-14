<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\SasaranBlockgrant;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = SasaranBlockgrant::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('sasaran_blockgrant_id')->primary();
            $table->decimal('tahun_ajaran_id', 4, 0);
            $table->bigInteger('jenis_sarana_id')->nullable();
            $table->bigInteger('jenis_prasarana_id')->nullable();
            $table->bigInteger('jenis_bantuan_id');
            $table->decimal('sumber_dana_id', 3, 0);
            $table->bigInteger('jumlah');
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
};
