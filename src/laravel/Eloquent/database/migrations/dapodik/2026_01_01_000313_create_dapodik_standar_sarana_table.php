<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\StandarSarana;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikStandarSaranaTable extends Migration
{
    protected $model = StandarSarana::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->uuid('id_std_sarana')->primary();
            $table->bigInteger('jenis_prasarana_id');
            $table->bigInteger('jenis_sarana_id');
            $table->string('jurusan_id', 25)->nullable();
            $table->bigInteger('bentuk_pendidikan_id');
            $table->boolean('a_harus_ada');
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
