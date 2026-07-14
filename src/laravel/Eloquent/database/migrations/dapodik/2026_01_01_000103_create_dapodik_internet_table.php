<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Internet;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Internet::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('internet_id')->primary();
            $table->uuid('sekolah_id');
            $table->decimal('jenis_layanan_internet_id', 2, 0)->nullable();
            $table->decimal('jenis_koneksi_id', 2, 0)->nullable();
            $table->string('provider', 30);
            $table->decimal('bandwidth', 10, 2);
            $table->decimal('bandwidth_up', 10, 2)->nullable();
            $table->decimal('bandwidth_down', 10, 2)->nullable();
            $table->smallInteger('latency')->nullable();
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
