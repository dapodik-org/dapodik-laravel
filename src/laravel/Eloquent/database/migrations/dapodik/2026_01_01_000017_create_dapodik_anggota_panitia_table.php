<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\AnggotaPanitia;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = AnggotaPanitia::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_ang_panitia')->primary();
            $table->uuid('id_panitia');
            $table->string('nm_ang', 100)->nullable();
            $table->string('no_kontak', 20)->nullable();
            $table->string('peran_ang', 30);
            $table->char('unsur_ang', 1);
            $table->uuid('peserta_didik_id')->nullable();
            $table->uuid('ptk_id')->nullable();
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
