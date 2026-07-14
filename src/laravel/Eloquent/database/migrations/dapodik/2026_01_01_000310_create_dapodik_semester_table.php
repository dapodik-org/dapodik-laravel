<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\Semester;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Semester::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->char('semester_id', 5)->primary();
            $table->bigInteger('tahun_ajaran_id');
            $table->string('nama');
            $table->decimal('semester', 1, 0);
            $table->boolean('periode_aktif');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
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
