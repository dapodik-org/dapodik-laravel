<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\KelompokBidang;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = KelompokBidang::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->char('level_bidang_id', 5)->primary();
            $table->string('nama_level_bidang');
            $table->boolean('untuk_sma');
            $table->boolean('untuk_smk');
            $table->boolean('untuk_pt');
            $table->boolean('untuk_slb');
            $table->boolean('untuk_smklb');
            $table->char('level_bidang_induk', 5)->nullable();
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
};
