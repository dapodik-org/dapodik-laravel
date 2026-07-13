<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\KesejahteraanPd;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikKesejahteraanPdTable extends Migration
{
    protected $model = KesejahteraanPd::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->uuid('id_sejahtera_pd')->primary();
            $table->uuid('peserta_didik_id');
            $table->integer('jenis_kesejahteraan_id');
            $table->string('nomor', 50);
            $table->string('nm_di_kartu', 100)->nullable();
            $table->decimal('dari_tahun', 4, 0);
            $table->decimal('sampai_tahun', 4, 0)->nullable();
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
