<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\TableSyncLog;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikTableSyncLogTable extends Migration
{
    protected $model = TableSyncLog::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->string('table_name', 30);
            $table->uuid('id_instalasi');
            $table->primary(['table_name', 'id_instalasi']);
            $table->timestamp('begin_sync');
            $table->timestamp('end_sync')->nullable();
            $table->char('sync_media', 1)->default('1');
            $table->decimal('is_success', 1, 0);
            $table->bigInteger('selisih_waktu_server');
            $table->integer('n_create');
            $table->integer('n_update');
            $table->integer('n_hapus');
            $table->integer('n_konflik');
            $table->integer('sync_page')->nullable()->default(0);
            $table->string('alamat_ip', 50);
            $table->uuid('pengguna_id');
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
        });
    }

    public function down()
    {
        $this->dropTable();
    }
}
