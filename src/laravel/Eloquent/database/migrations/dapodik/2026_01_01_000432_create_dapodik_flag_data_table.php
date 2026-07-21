<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\FlagData;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = FlagData::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('flag_id')->primary();
            $table->uuid('peserta_didik_id')->nullable();
            $table->uuid('sekolah_id')->nullable();
            $table->integer('jenis_flag_id');
            $table->uuid('ptk_id')->nullable();
            $table->char('asal_data', 1);
            $table->uuid('updater_id');
            $table->date('value_date')->nullable();
            $table->integer('value_int')->nullable();
            $table->decimal('value_double')->nullable();
            $table->string('value_string', 100)->nullable();
            $table->date('mulai_dari')->nullable();
            $table->date('berlaku_sampai')->nullable();
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
