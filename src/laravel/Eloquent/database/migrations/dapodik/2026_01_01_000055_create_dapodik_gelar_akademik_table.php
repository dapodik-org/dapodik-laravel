<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\GelarAkademik;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikGelarAkademikTable extends Migration
{
    protected $model = GelarAkademik::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('gelar_akademik_id')->primary();
            $table->string('kode');
            $table->string('nama');
            $table->decimal('posisi_gelar', 1, 0);
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
