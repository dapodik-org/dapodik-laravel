<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\EkstraKurikuler;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikEkstraKurikulerTable extends Migration
{
    protected $model = EkstraKurikuler::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('id_ekskul')->primary();
            $table->string('nm_ekskul');
            $table->boolean('u_sd')->default(false);
            $table->boolean('u_smp')->default(false);
            $table->boolean('u_sma')->default(false);
            $table->boolean('u_smk')->default(false);
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
