<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\TableSync;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikTableSyncTable extends Migration
{
    protected $model = TableSync::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->string('table_name', 30)->primary();
            $table->string('table_alias', 50)->nullable();
            $table->char('sync_type', 1);
            $table->decimal('sync_seq', 4, 0);
            $table->string('kolom_kecuali', 200)->nullable();
            $table->smallInteger('table_status')->nullable();
            $table->string('table_ket', 100)->nullable();
            $table->smallInteger('jml_thread')->nullable();
            $table->bigInteger('baris_per_thread')->nullable();
            $table->string('order_ekstra', 100)->nullable();
            $table->decimal('a_table_aktif', 1, 0);
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
