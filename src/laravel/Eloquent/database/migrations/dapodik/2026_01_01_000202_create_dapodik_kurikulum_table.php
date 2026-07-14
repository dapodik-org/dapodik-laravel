<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\Kurikulum;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Kurikulum::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('kurikulum_id')->primary();
            $table->string('nama_kurikulum');
            $table->date('mulai_berlaku');
            $table->boolean('sistem_sks')->default(false);
            $table->decimal('total_sks', 3, 0)->default(0);
            $table->bigInteger('jenjang_pendidikan_id');
            $table->char('jurusan_id', 25)->nullable();
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
