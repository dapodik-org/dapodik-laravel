<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\JurSpLong;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = JurSpLong::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('jurusan_sp_id');
            $table->char('semester_id', 5);
            $table->primary(['jurusan_sp_id', 'semester_id']);
            $table->decimal('jumlah_pendaftar', 5, 0)->default(0);
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
};
