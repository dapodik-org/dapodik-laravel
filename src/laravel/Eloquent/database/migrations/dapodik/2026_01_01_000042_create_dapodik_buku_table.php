<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Buku;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = Buku::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_buku')->primary();
            $table->integer('mata_pelajaran_id');
            $table->uuid('id_ruang')->nullable();
            $table->uuid('sekolah_id');
            $table->uuid('id_biblio')->nullable();
            $table->decimal('tingkat_pendidikan_id', 2, 0)->nullable();
            $table->string('nm_buku', 256);
            $table->char('id_hapus_buku', 1)->nullable();
            $table->date('tgl_hapus_buku')->nullable();
            $table->char('asal_data', 1)->default('1');
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
