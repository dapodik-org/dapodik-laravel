<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RwyFungsional;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikRwyFungsionalTable extends Migration
{
    protected $model = RwyFungsional::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('riwayat_fungsional_id')->primary();
            $table->uuid('ptk_id');
            $table->decimal('jabatan_fungsional_id', 5, 0);
            $table->string('sk_jabfung', 80);
            $table->date('tmt_jabatan');
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
}
