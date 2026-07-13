<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\VariabelValue;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikVariabelValueTable extends Migration
{
    protected $model = VariabelValue::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->char('variabel_id', 36);
            $table->bigInteger('value_id');
            $table->string('value_name', 200);
            $table->primary(['variabel_id', 'value_id']);
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
