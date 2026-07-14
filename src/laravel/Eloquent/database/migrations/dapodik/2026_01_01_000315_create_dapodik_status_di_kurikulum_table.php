<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\StatusDiKurikulum;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = StatusDiKurikulum::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('status_di_kurikulum')->primary();
            $table->string('ket_stat_di_kurikulum');
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
};
