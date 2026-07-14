<?php

use Dapodik\Laravel\Eloquent\Migration;
use Dapodik\Laravel\Eloquent\Models\Ref\BidangStudi;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    protected $model = BidangStudi::class;

    public function up()
    {
        $this->createSchemaIfNotExist();

        $this->createTable(function (Blueprint $table) {
            $table->bigInteger('bidang_studi_id')->primary();
            $table->bigInteger('kelompok_bidang_studi_id')->nullable();
            $table->string('kode')->nullable();
            $table->string('bidang_studi');
            $table->boolean('kelompok');
            $table->boolean('jenjang_paud');
            $table->boolean('jenjang_tk');
            $table->boolean('jenjang_sd');
            $table->boolean('jenjang_smp');
            $table->boolean('jenjang_sma');
            $table->boolean('jenjang_tinggi');
            $table->boolean('a_sert_komp')->default(false);
            $table->boolean('a_sert_profesi')->default(false);
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
