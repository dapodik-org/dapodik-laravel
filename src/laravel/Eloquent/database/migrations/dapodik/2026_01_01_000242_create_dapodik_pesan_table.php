<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Pesan;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Pesan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('pesan_id')->primary();
            $table->uuid('sekolah_id')->nullable();
            $table->smallInteger('jenis_pesan_id');
            $table->string('judul', 100);
            $table->text('deskripsi');
            $table->smallInteger('status_pesan');
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
