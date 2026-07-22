<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\AkreditasiSp;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = AkreditasiSp::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('akred_sp_id')->primary();
            $table->uuid('sekolah_id')->nullable();
            $table->string('akred_sp_sk', 80)->nullable();
            $table->date('akred_sp_tmt')->nullable();
            $table->date('akred_sp_tst')->nullable();
            $table->decimal('akreditasi_id', 1, 0)->nullable();
            $table->char('la_id', 5)->nullable();
            $table->uuid('updater_id')->nullable();
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
