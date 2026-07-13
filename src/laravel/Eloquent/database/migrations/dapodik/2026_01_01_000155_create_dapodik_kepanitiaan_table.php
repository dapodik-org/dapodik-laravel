<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Kepanitiaan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikKepanitiaanTable extends Migration
{
    protected $model = Kepanitiaan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_panitia')->primary();
            $table->uuid('sekolah_id')->nullable();
            $table->integer('id_jns_panitia');
            $table->string('nm_panitia', 80);
            $table->string('instansi', 100);
            $table->char('tkt_panitia', 1);
            $table->string('sk_tugas', 80);
            $table->date('tmt_sk_tugas');
            $table->date('tst_sk_tugas')->nullable();
            $table->decimal('a_pasang_papan', 1, 0);
            $table->decimal('a_formulir', 1, 0);
            $table->decimal('a_silabus', 1, 0);
            $table->decimal('a_berlaku_pos', 1, 0);
            $table->decimal('a_sosialisasi_pos', 1, 0);
            $table->decimal('a_ks_edukatif', 1, 0);
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
