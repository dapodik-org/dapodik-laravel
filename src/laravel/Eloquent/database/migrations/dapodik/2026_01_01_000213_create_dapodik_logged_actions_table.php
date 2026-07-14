<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Audit\LoggedActions;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = LoggedActions::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigIncrements('event_id');
            $table->string('schema_name');
            $table->string('table_name');
            $table->unsignedInteger('relid');
            $table->string('session_user_name')->nullable();
            $table->timestampTz('action_tstamp_tx');
            $table->timestampTz('action_tstamp_stm');
            $table->timestampTz('action_tstamp_clk');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->string('application_name')->nullable();
            $table->string('client_addr', 39)->nullable();
            $table->integer('client_port')->nullable();
            $table->text('client_query')->nullable();
            $table->string('action');
            $table->text('row_data')->nullable();
            $table->text('changed_fields')->nullable();
            $table->boolean('statement_only');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
};
