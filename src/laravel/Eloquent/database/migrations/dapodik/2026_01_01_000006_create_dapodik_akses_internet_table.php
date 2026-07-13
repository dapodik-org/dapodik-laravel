<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\AksesInternet;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikAksesInternetTable extends Migration
{
    protected $model = AksesInternet::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function(Blueprint $table) {
            $table->bigInteger('akses_internet_id')->primary();
            $table->string('nama');
            $table->decimal('media', 1, 0);
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
