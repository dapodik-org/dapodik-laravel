<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\Mulok;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikMulokTable extends Migration
{
    protected $model = Mulok::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->char('kode_wilayah', 8);
            $table->bigInteger('mata_pelajaran_id');
            $table->string('sk_mulok', 80);
            $table->date('tgl_sk_mulok');
            $table->primary(['kode_wilayah', 'mata_pelajaran_id']);
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
