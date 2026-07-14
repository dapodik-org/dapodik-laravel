<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\BatasWaktuRapor;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = BatasWaktuRapor::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->char('semester_id', 5)->primary();
            $table->date('tgl_rapor_mulai');
            $table->date('tgl_rapor_selesai');
            $table->date('tgl_usm_mulai')->nullable();
            $table->date('tgl_usm_selesai')->nullable();
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
