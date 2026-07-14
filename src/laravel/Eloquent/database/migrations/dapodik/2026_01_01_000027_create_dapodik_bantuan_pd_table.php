<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\BantuanPd;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = BantuanPd::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_bantuan_pd')->primary();
            $table->integer('jenis_bantuan_id');
            $table->uuid('anggota_rombel_id');
            $table->decimal('besar_bantuan', 15, 0);
            $table->decimal('dana_pendamping', 15, 0);
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
