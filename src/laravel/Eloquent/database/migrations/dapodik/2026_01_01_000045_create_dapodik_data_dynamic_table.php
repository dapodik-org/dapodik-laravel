<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\DataDynamic;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikDataDynamicTable extends Migration
{
    protected $model = DataDynamic::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('sekolah_id');
            $table->uuid('variabel_id');
            $table->primary(['sekolah_id', 'variabel_id']);
            $table->char('asal_data', 1)->default('1');
            $table->integer('value_int')->nullable();
            $table->decimal('value_double', 30, 8)->nullable();
            $table->string('value_string', 100)->nullable();
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
