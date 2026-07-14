<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisPesan;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = JenisPesan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->smallInteger('jenis_pesan_id')->primary();
            $table->string('kelompok', 25);
            $table->string('nama', 50);
            $table->timestamp('create_date')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes('expired_date');
        });
    }

    public function down()
    {
        $this->dropTable();
    }
};
