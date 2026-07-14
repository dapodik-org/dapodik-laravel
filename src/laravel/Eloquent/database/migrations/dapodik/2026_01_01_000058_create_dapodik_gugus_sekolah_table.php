<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\GugusSekolah;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = GugusSekolah::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('gugus_id')->primary();
            $table->char('asal_data', 1)->default('1');
            $table->string('nama', 50);
            $table->string('sk_gugus', 80)->nullable();
            $table->decimal('jenis_gugus_id', 3, 0);
            $table->uuid('sekolah_inti_id')->nullable();
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
