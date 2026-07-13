<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\Variabel;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikVariabelTable extends Migration
{
    protected $model = Variabel::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('variabel_id')->primary();
            $table->string('nama', 500);
            $table->string('header', 500)->nullable();
            $table->smallInteger('urut')->nullable();
            $table->string('string_pattern', 500)->nullable();
            $table->string('keterangan', 500)->nullable();
            $table->char('jenis_variabel', 1);
            $table->decimal('u_paud', 1, 0);
            $table->decimal('u_sd', 1, 0);
            $table->decimal('u_smp', 1, 0);
            $table->decimal('u_sma', 1, 0);
            $table->decimal('u_smk', 1, 0);
            $table->decimal('is_tampil', 1, 0);
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
