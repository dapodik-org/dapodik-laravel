<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\PemakaiPrasarana;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikPemakaiPrasaranaTable extends Migration
{
    protected $model = PemakaiPrasarana::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('jenis_prasarana_id');
            $table->char('jurusan_id', 25);
            $table->integer('jml_std_min')->default(0);
            $table->primary(['jenis_prasarana_id', 'jurusan_id']);
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
