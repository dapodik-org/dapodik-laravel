<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\TingkatPendidikan;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = TingkatPendidikan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('tingkat_pendidikan_id')->primary();
            $table->string('kode');
            $table->string('nama');
            $table->bigInteger('jenjang_pendidikan_id');
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
