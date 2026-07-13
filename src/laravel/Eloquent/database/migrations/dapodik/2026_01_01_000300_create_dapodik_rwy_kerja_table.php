<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\RwyKerja;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikRwyKerjaTable extends Migration
{
    protected $model = RwyKerja::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('rwy_kerja_id')->primary();
            $table->decimal('jenjang_pendidikan_id', 2, 0)->nullable();
            $table->decimal('jenis_lembaga_id', 5, 0);
            $table->smallInteger('status_kepegawaian_id');
            $table->uuid('ptk_id');
            $table->decimal('jenis_ptk_id', 2, 0);
            $table->string('lembaga_pengangkat', 100);
            $table->string('no_sk_kerja', 80);
            $table->date('tgl_sk_kerja');
            $table->date('tmt_kerja');
            $table->date('tst_kerja')->nullable();
            $table->string('tempat_kerja', 100);
            $table->string('ttd_sk_kerja', 80)->nullable();
            $table->string('mapel_diajarkan', 80)->nullable();
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
