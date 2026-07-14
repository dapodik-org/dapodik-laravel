<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\VersiDb;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikVersiDbTable extends Migration
{
    protected $model = VersiDb::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->decimal('versi_id', 1, 0)->default(1);
            $table->string('versi', 20)->default('2.105');
            $table->timestamp('tanggal_update');
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
