<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\JenisHapusBuku;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikJenisHapusBukuTable extends Migration
{
    protected $model = JenisHapusBuku::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->char('id_hapus_buku', 1)->primary();
            $table->string('ket_hapus_buku');
            $table->boolean('u_prasarana');
            $table->boolean('u_sarana');
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
