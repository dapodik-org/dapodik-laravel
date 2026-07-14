<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\AktPd;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikAktPdTable extends Migration
{
    protected $model = AktPd::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_akt_pd')->primary();
            $table->uuid('mou_id');
            $table->decimal('id_jns_akt_pd', 3, 0);
            $table->string('judul_akt_pd', 500);
            $table->string('sk_tugas', 80)->nullable();
            $table->date('tgl_sk_tugas')->nullable();
            $table->text('ket_akt')->nullable();
            $table->decimal('a_komunal', 1, 0);
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
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
}
