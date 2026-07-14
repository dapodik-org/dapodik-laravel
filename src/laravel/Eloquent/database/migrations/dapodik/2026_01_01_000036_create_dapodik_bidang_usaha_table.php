<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\BidangUsaha;
use Illuminate\Database\Schema\Blueprint;

class CreateDapodikBidangUsahaTable extends Migration
{
    protected $model = BidangUsaha::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->char('bidang_usaha_id', 10)->primary();
            $table->string('nama_bidang_usaha');
            $table->string('level_bidang_usaha')->nullable();
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
