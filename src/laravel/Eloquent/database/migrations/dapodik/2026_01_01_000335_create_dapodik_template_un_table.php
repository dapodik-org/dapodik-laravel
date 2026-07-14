<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\TemplateUn;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = TemplateUn::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('template_id')->primary();
            $table->decimal('jenjang_pendidikan_id', 2, 0);
            $table->decimal('tahun_ajaran_id', 4, 0);
            $table->string('jurusan_id', 25)->nullable();
            $table->string('template_ket', 250)->nullable();
            $table->bigInteger('mp1_id')->nullable();
            $table->bigInteger('mp2_id')->nullable();
            $table->bigInteger('mp3_id')->nullable();
            $table->bigInteger('mp4_id')->nullable();
            $table->bigInteger('mp5_id')->nullable();
            $table->bigInteger('mp6_id')->nullable();
            $table->bigInteger('mp7_id')->nullable();
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
