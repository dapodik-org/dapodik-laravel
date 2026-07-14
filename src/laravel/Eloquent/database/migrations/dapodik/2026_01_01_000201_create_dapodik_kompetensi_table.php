<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\Kompetensi;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Kompetensi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_komp')->primary();
            $table->text('desk');
            $table->string('nmr', 5);
            $table->char('kelompok', 1);
            $table->bigInteger('versi');
            $table->uuid('id_inti_dasar')->nullable();
            $table->decimal('level_komp', 3, 0)->nullable();
            $table->decimal('tingkat_pendidikan_id', 2, 0);
            $table->smallInteger('kurikulum_id');
            $table->bigInteger('mata_pelajaran_id');
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
