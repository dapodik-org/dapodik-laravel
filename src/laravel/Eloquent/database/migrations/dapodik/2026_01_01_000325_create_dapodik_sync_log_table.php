<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\SyncLog;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = SyncLog::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_instalasi');
            $table->timestamp('begin_sync');
            $table->timestamp('end_sync')->nullable();
            $table->char('sync_media', 1)->default('1');
            $table->decimal('is_success', 1, 0);
            $table->bigInteger('selisih_waktu_server');
            $table->string('alamat_ip', 50);
            $table->uuid('pengguna_id');
            $table->timestamp('create_date')->nullable();
            $table->timestamp('last_update')->nullable();
            $table->primary(['id_instalasi', 'begin_sync']);
        });
    }

    public function down()
    {
        $this->dropTable();
    }
};
