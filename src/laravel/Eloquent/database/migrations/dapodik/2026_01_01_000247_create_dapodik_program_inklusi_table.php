<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\ProgramInklusi;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = ProgramInklusi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_pi')->primary();
            $table->uuid('sekolah_id');
            $table->integer('kebutuhan_khusus_id');
            $table->string('sk_pi', 80);
            $table->date('tgl_sk_pi')->nullable();
            $table->date('tmt_pi');
            $table->date('tst_pi')->nullable();
            $table->string('ket_pi', 200)->nullable();
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
};
