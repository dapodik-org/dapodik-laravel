<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisKesejahteraan;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisKesejahteraanTable extends Migration
{
    protected $model = JenisKesejahteraan::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('jenis_kesejahteraan_id')->primary();
            $table->string('nama');
            $table->string('penyelenggara');
            $table->boolean('u_ptk')->default(true);
            $table->boolean('u_pd')->default(false);
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
}
