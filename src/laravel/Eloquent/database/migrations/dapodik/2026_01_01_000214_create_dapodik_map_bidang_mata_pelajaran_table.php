<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\MapBidangMataPelajaran;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = MapBidangMataPelajaran::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('mata_pelajaran_id');
            $table->bigInteger('bidang_studi_id');
            $table->decimal('sesuai', 1, 0);
            $table->primary(['mata_pelajaran_id', 'bidang_studi_id']);
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
